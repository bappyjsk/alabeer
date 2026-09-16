<?php

namespace App\Services;

use App\Models\Guest;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\Folio;
use App\Models\FolioItem;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ReservationService
{
    /**
     * Create a new reservation.
     */
    public function createReservation(array $data): Reservation
    {
        return DB::transaction(function () use ($data) {
            // Find or create guest
            $guest = Guest::firstOrCreate(
                ['id_number' => $data['id_number']],
                [
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'] ?? '',
                    'full_name_ar' => $data['full_name_ar'] ?? null,
                    'mobile_number' => $data['mobile_number'],
                    'id_type' => $data['id_type'] ?? 'national_id',
                    'nationality' => $data['nationality'] ?? 'SA',
                ]
            );

            $roomType = RoomType::findOrFail($data['room_type_id']);
            $checkIn = Carbon::parse($data['check_in_date']);
            $checkOut = Carbon::parse($data['check_out_date']);
            $nights = max(1, $checkIn->diffInDays($checkOut));
            $nightlyRate = $data['nightly_rate'] ?? $roomType->base_price;
            $totalAmount = $nightlyRate * $nights;

            $room = null;
            if (!empty($data['room_id'])) {
                $room = Room::find($data['room_id']);
            }

            $reservation = Reservation::create([
                'reservation_no' => 'NZ-' . rand(10000, 99999),
                'property_id' => $data['property_id'] ?? 1,
                'guest_id' => $guest->id,
                'room_id' => $room?->id,
                'room_type_id' => $roomType->id,
                'check_in_date' => $checkIn,
                'check_out_date' => $checkOut,
                'adults' => $data['adults'] ?? 1,
                'children' => $data['children'] ?? 0,
                'nightly_rate' => $nightlyRate,
                'total_amount' => $totalAmount,
                'paid_amount' => $data['paid_amount'] ?? 0,
                'status' => $data['status'] ?? 'confirmed',
                'source' => $data['source'] ?? 'direct',
                'special_requests' => $data['special_requests'] ?? null,
            ]);

            // Create Folio
            $folio = Folio::create([
                'folio_number' => 'FOL-' . $reservation->reservation_no,
                'property_id' => $reservation->property_id,
                'reservation_id' => $reservation->id,
                'guest_id' => $guest->id,
                'total_charges' => $totalAmount,
                'total_payments' => $reservation->paid_amount,
                'balance' => $totalAmount - $reservation->paid_amount,
                'status' => ($totalAmount == $reservation->paid_amount) ? 'settled' : 'open',
            ]);

            // Add Folio Room Charge Item
            FolioItem::create([
                'folio_id' => $folio->id,
                'category' => 'room_charge',
                'description' => "Room Charges ({$nights} Nights)",
                'unit_price' => $nightlyRate,
                'quantity' => $nights,
                'tax_rate' => 15.00,
                'tax_amount' => round($totalAmount * 0.15 / 1.15, 2),
                'total_amount' => $totalAmount,
            ]);

            // Record payment if provided
            if ($reservation->paid_amount > 0) {
                Payment::create([
                    'folio_id' => $folio->id,
                    'property_id' => $reservation->property_id,
                    'payment_number' => 'PAY-' . strtoupper(Str::random(8)),
                    'amount' => $reservation->paid_amount,
                    'payment_method' => $data['payment_method'] ?? 'mada',
                    'transaction_ref' => 'TXN-' . strtoupper(Str::random(6)),
                    'paid_at' => now(),
                ]);
            }

            // Update room status to reserved if room specified
            if ($room && $reservation->status === 'confirmed') {
                $room->update(['status' => 'reserved']);
            }

            return $reservation;
        });
    }

    /**
     * Check in a reservation.
     */
    public function checkIn(int $reservationId, ?int $roomId = null): Reservation
    {
        return DB::transaction(function () use ($reservationId, $roomId) {
            $reservation = Reservation::with('room')->findOrFail($reservationId);

            if ($roomId) {
                $room = Room::findOrFail($roomId);
                $reservation->room_id = $room->id;
            } else {
                $room = $reservation->room;
            }

            $reservation->status = 'checked_in';
            $reservation->actual_check_in_at = now();
            $reservation->save();

            if ($room) {
                $room->update(['status' => 'occupied']);
            }

            // Dispatch Shomoos security clearance transaction
            app(ShomoosService::class)->syncCheckIn($reservation);

            return $reservation;
        });
    }

    /**
     * Check out a reservation.
     */
    public function checkOut(int $reservationId): Reservation
    {
        return DB::transaction(function () use ($reservationId) {
            $reservation = Reservation::with('room', 'folio')->findOrFail($reservationId);

            $reservation->status = 'checked_out';
            $reservation->actual_check_out_at = now();
            $reservation->save();

            if ($reservation->room) {
                // Once checked out, room becomes vacant dirty awaiting housekeeping
                $reservation->room->update(['status' => 'vacant_dirty']);
            }

            if ($reservation->folio) {
                $reservation->folio->update(['status' => 'closed', 'closed_at' => now()]);
            }

            // Dispatch Shomoos check-out synchronization
            app(ShomoosService::class)->syncCheckOut($reservation);

            return $reservation;
        });
    }
}