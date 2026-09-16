<?php

namespace App\Http\Controllers;

use App\Services\ReservationService;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    protected ReservationService $reservationService;

    public function __construct(ReservationService $reservationService)
    {
        $this->reservationService = $reservationService;
    }

    /**
     * Display reservations inventory and room allocation matrix.
     */
    public function index(Request $request)
    {
        $today = Carbon::today();
        
        $totalRooms = Room::count();
        $vacantCount = Room::where('status', 'vacant_clean')->count();
        $rentedCount = Room::where('status', 'occupied')->count();
        $waitingCheckInCount = Reservation::whereDate('check_in_date', $today)->where('status', 'confirmed')->count();
        $checkOutTodayCount = Room::where('status', 'due_out')->count();
        $occupancyRate = $totalRooms > 0 ? round(($rentedCount / $totalRooms) * 100, 1) : 66.7;

        $rooms = Room::with(['roomType', 'currentReservation.guest', 'currentReservation.folio'])
            ->orderBy('room_number')
            ->get();

        $roomTypes = RoomType::all();
        $vacantRooms = Room::where('status', 'vacant_clean')->orderBy('room_number')->get();

        return view('reservations.index', compact(
            'rooms',
            'roomTypes',
            'vacantRooms',
            'totalRooms',
            'vacantCount',
            'rentedCount',
            'waitingCheckInCount',
            'checkOutTodayCount',
            'occupancyRate'
        ));
    }

    /**
     * Store a new reservation.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string'],
            'last_name' => ['nullable', 'string'],
            'id_number' => ['required', 'string'],
            'mobile_number' => ['required', 'string'],
            'room_type_id' => ['required', 'exists:room_types,id'],
            'room_id' => ['nullable', 'exists:rooms,id'],
            'check_in_date' => ['required', 'date'],
            'check_out_date' => ['required', 'date', 'after:check_in_date'],
            'adults' => ['nullable', 'integer', 'min:1'],
            'paid_amount' => ['nullable', 'numeric', 'min:0'],
            'payment_method' => ['nullable', 'string'],
            'special_requests' => ['nullable', 'string'],
        ]);

        $reservation = $this->reservationService->createReservation($validated);

        return redirect()->route('dashboard')->with('success', "Reservation #{$reservation->reservation_no} created successfully.");
    }

    /**
     * Instant Walk-in Check-in.
     */
    public function walkIn(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string'],
            'last_name' => ['nullable', 'string'],
            'id_number' => ['required', 'string'],
            'mobile_number' => ['required', 'string'],
            'room_id' => ['required', 'exists:rooms,id'],
            'room_type_id' => ['required', 'exists:room_types,id'],
            'check_in_date' => ['required', 'date'],
            'check_out_date' => ['required', 'date', 'after:check_in_date'],
            'paid_amount' => ['required', 'numeric', 'min:0'],
            'payment_method' => ['required', 'string'],
        ]);

        $validated['status'] = 'checked_in';
        $reservation = $this->reservationService->createReservation($validated);
        $this->reservationService->checkIn($reservation->id, $validated['room_id']);

        return redirect()->route('dashboard')->with('success', "Walk-in Guest checked into Room successfully.");
    }

    /**
     * Perform Check-in.
     */
    public function checkIn(int $id)
    {
        $reservation = $this->reservationService->checkIn($id);

        return redirect()->route('dashboard')->with('success', "Reservation #{$reservation->reservation_no} checked in successfully.");
    }

    /**
     * Perform Check-out.
     */
    public function checkOut(int $id)
    {
        $reservation = $this->reservationService->checkOut($id);

        return redirect()->route('dashboard')->with('success', "Reservation #{$reservation->reservation_no} checked out. Room is now flagged for Housekeeping.");
    }

    /**
     * Change room cleaning / maintenance status.
     */
    public function updateRoomStatus(Request $request, int $roomId)
    {
        $request->validate(['status' => 'required|string']);
        $room = Room::findOrFail($roomId);
        $room->update(['status' => $request->status]);

        return redirect()->route('dashboard')->with('success', "Room {$room->room_number} status updated to {$request->status}.");
    }
}