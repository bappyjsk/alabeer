<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;
use App\Models\RoomType;
use App\Models\Room;
use App\Models\Guest;
use App\Models\Reservation;
use App\Models\Folio;
use App\Models\FolioItem;
use App\Models\Payment;
use App\Models\Service;
use App\Models\HousekeepingTask;
use App\Models\ShomoosTransaction;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PmsSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Property
        $property = Property::updateOrCreate(
            ['code' => '1001'],
            [
                'name_en' => 'alabeer Furnished Suites - Branch 1001',
                'name_ar' => '????? ??????? ???????? - ??? 1001',
                'category' => 'furnished_apartments',
                'cr_number' => '1010849201',
                'vat_number' => '310293847500003',
                'shamous_hotel_id' => 'SHM-RUH-892',
                'city' => 'Riyadh',
                'currency' => 'SAR',
            ]
        );

        // 2. Room Types
        $execType = RoomType::firstOrCreate(
            ['property_id' => $property->id, 'code' => 'EXEC'],
            [
                'name_en' => 'Executive Suite',
                'name_ar' => '???? ?????? ????',
                'base_price' => 550.00,
                'max_adults' => 3,
                'max_children' => 2,
            ]
        );

        $stdType = RoomType::firstOrCreate(
            ['property_id' => $property->id, 'code' => 'STD1B'],
            [
                'name_en' => 'Standard 1-Bedroom',
                'name_ar' => '??? ???? ????? ??????',
                'base_price' => 350.00,
                'max_adults' => 2,
                'max_children' => 1,
            ]
        );

        $dlxType = RoomType::firstOrCreate(
            ['property_id' => $property->id, 'code' => 'DLX'],
            [
                'name_en' => 'Deluxe Studio',
                'name_ar' => '??????? ?????? ?????',
                'base_price' => 280.00,
                'max_adults' => 2,
                'max_children' => 0,
            ]
        );

        // 3. Rooms Setup (Floor 1 & Floor 2)
        $roomStatuses = [
            101 => ['status' => 'occupied', 'type' => $execType],
            102 => ['status' => 'vacant_clean', 'type' => $execType],
            103 => ['status' => 'occupied', 'type' => $execType],
            104 => ['status' => 'due_out', 'type' => $execType],
            105 => ['status' => 'reserved', 'type' => $execType],
            106 => ['status' => 'occupied', 'type' => $execType],
            107 => ['status' => 'vacant_clean', 'type' => $execType],
            108 => ['status' => 'vacant_dirty', 'type' => $execType],
            109 => ['status' => 'occupied', 'type' => $execType],
            110 => ['status' => 'vacant_clean', 'type' => $execType],

            201 => ['status' => 'occupied', 'type' => $stdType],
            202 => ['status' => 'occupied', 'type' => $stdType],
            203 => ['status' => 'vacant_clean', 'type' => $stdType],
            204 => ['status' => 'reserved', 'type' => $stdType],
            205 => ['status' => 'due_out', 'type' => $stdType],
            206 => ['status' => 'occupied', 'type' => $stdType],
            207 => ['status' => 'vacant_clean', 'type' => $stdType],
            208 => ['status' => 'vacant_clean', 'type' => $dlxType],
            209 => ['status' => 'occupied', 'type' => $dlxType],
            210 => ['status' => 'maintenance', 'type' => $dlxType],
        ];

        $rooms = [];
        foreach ($roomStatuses as $roomNo => $cfg) {
            $floor = (int) substr((string)$roomNo, 0, 1);
            $rooms[$roomNo] = Room::updateOrCreate(
                ['property_id' => $property->id, 'room_number' => (string)$roomNo],
                [
                    'room_type_id' => $cfg['type']->id,
                    'floor' => $floor,
                    'status' => $cfg['status'],
                    'smart_lock_id' => 'LOCK-' . $roomNo,
                ]
            );
        }

        // 4. Guests
        $guestsData = [
            ['first_name' => 'Mohammed', 'last_name' => 'Al-Otaibi', 'full_name_ar' => '???? ???????', 'id_number' => '1082938172', 'mobile' => '+966501234567'],
            ['first_name' => 'Abdullah', 'last_name' => 'Al-Ghamdi', 'full_name_ar' => '??????? ???????', 'id_number' => '1045928192', 'mobile' => '+966559876543'],
            ['first_name' => 'Fahad', 'last_name' => 'Al-Shehri', 'full_name_ar' => '??? ??????', 'id_number' => '1073829103', 'mobile' => '+966543332211'],
            ['first_name' => 'Sultan', 'last_name' => 'Al-Qahtani', 'full_name_ar' => '????? ????????', 'id_number' => '1029384756', 'mobile' => '+966564448899'],
            ['first_name' => 'Khaled', 'last_name' => 'Al-Mutairi', 'full_name_ar' => '???? ???????', 'id_number' => '1058291034', 'mobile' => '+966505556677'],
            ['first_name' => 'Nasser', 'last_name' => 'Al-Harbi', 'full_name_ar' => '???? ??????', 'id_number' => '1039281745', 'mobile' => '+966551122334'],
            ['first_name' => 'Tariq', 'last_name' => 'Al-Salem', 'full_name_ar' => '???? ??????', 'id_number' => '1068492019', 'mobile' => '+966548889900'],
            ['first_name' => 'Omar', 'last_name' => 'Al-Balawi', 'full_name_ar' => '??? ??????', 'id_number' => '1093847291', 'mobile' => '+966561239874'],
            ['first_name' => 'Bander', 'last_name' => 'Al-Majed', 'full_name_ar' => '???? ??????', 'id_number' => '1019283746', 'mobile' => '+966509988776'],
            ['first_name' => 'Yousef', 'last_name' => 'Al-Anazi', 'full_name_ar' => '???? ??????', 'id_number' => '1084729104', 'mobile' => '+966552233445'],
        ];

        $guests = [];
        foreach ($guestsData as $g) {
            $guests[] = Guest::updateOrCreate(
                ['id_number' => $g['id_number']],
                [
                    'first_name' => $g['first_name'],
                    'last_name' => $g['last_name'],
                    'full_name_ar' => $g['full_name_ar'],
                    'id_type' => 'national_id',
                    'nationality' => 'SA',
                    'mobile_number' => $g['mobile'],
                    'email' => strtolower($g['first_name']) . '@example.com',
                ]
            );
        }

        // 5. Active & Arriving Reservations
        $today = Carbon::today();

        // Arriving today (Suite 105 - Mohammed Al-Otaibi)
        $res1 = Reservation::updateOrCreate(
            ['reservation_no' => 'NZ-84920'],
            [
                'property_id' => $property->id,
                'guest_id' => $guests[0]->id,
                'room_id' => $rooms[105]->id,
                'room_type_id' => $execType->id,
                'check_in_date' => $today,
                'check_out_date' => $today->copy()->addDays(3),
                'adults' => 2,
                'nightly_rate' => 450.00,
                'total_amount' => 1350.00,
                'paid_amount' => 1350.00,
                'status' => 'confirmed',
                'source' => 'direct',
            ]
        );

        // Arriving today (Suite 204 - Abdullah Al-Ghamdi)
        $res2 = Reservation::updateOrCreate(
            ['reservation_no' => 'NZ-84921'],
            [
                'property_id' => $property->id,
                'guest_id' => $guests[1]->id,
                'room_id' => $rooms[204]->id,
                'room_type_id' => $stdType->id,
                'check_in_date' => $today,
                'check_out_date' => $today->copy()->addDays(2),
                'adults' => 1,
                'nightly_rate' => 460.00,
                'total_amount' => 920.00,
                'paid_amount' => 0.00,
                'status' => 'confirmed',
                'source' => 'walk_in',
            ]
        );

        // In-House / Checked In (Room 101 - Fahad Al-Shehri)
        $res3 = Reservation::updateOrCreate(
            ['reservation_no' => 'NZ-84915'],
            [
                'property_id' => $property->id,
                'guest_id' => $guests[2]->id,
                'room_id' => $rooms[101]->id,
                'room_type_id' => $execType->id,
                'check_in_date' => $today->copy()->subDays(1),
                'check_out_date' => $today->copy()->addDays(2),
                'actual_check_in_at' => $today->copy()->subDays(1)->setHour(14),
                'adults' => 2,
                'nightly_rate' => 550.00,
                'total_amount' => 1650.00,
                'paid_amount' => 1650.00,
                'status' => 'checked_in',
                'source' => 'booking_com',
            ]
        );

        // 6. Folios & Payments
        foreach ([$res1, $res2, $res3] as $res) {
            $folio = Folio::updateOrCreate(
                ['reservation_id' => $res->id],
                [
                    'folio_number' => 'FOL-' . $res->reservation_no,
                    'property_id' => $property->id,
                    'guest_id' => $res->guest_id,
                    'total_charges' => $res->total_amount,
                    'total_payments' => $res->paid_amount,
                    'balance' => $res->total_amount - $res->paid_amount,
                    'status' => ($res->total_amount == $res->paid_amount) ? 'settled' : 'open',
                ]
            );

            // Folio Room Charge Item
            FolioItem::updateOrCreate(
                ['folio_id' => $folio->id, 'description' => 'Room Accommodation Charges'],
                [
                    'category' => 'room_charge',
                    'unit_price' => $res->nightly_rate,
                    'quantity' => $res->check_in_date->diffInDays($res->check_out_date) ?: 1,
                    'tax_rate' => 15.00,
                    'tax_amount' => round($res->total_amount * 0.15 / 1.15, 2),
                    'total_amount' => $res->total_amount,
                ]
            );

            if ($res->paid_amount > 0) {
                Payment::updateOrCreate(
                    ['folio_id' => $folio->id, 'payment_number' => 'PAY-' . $res->reservation_no],
                    [
                        'property_id' => $property->id,
                        'amount' => $res->paid_amount,
                        'payment_method' => 'mada',
                        'transaction_ref' => 'MADA-' . strtoupper(Str::random(8)),
                        'paid_at' => now(),
                    ]
                );

                // ZATCA Invoice
                Invoice::updateOrCreate(
                    ['folio_id' => $folio->id],
                    [
                        'property_id' => $property->id,
                        'invoice_number' => 'INV-2026-' . $res->id,
                        'invoice_uuid' => (string) Str::uuid(),
                        'subtotal' => round($res->paid_amount / 1.15, 2),
                        'tax_amount' => round($res->paid_amount * 0.15 / 1.15, 2),
                        'grand_total' => $res->paid_amount,
                        'zatca_status' => 'cleared',
                    ]
                );
            }
        }

        // 7. Shomoos Integration Log
        ShomoosTransaction::updateOrCreate(
            ['reservation_id' => $res1->id],
            [
                'property_id' => $property->id,
                'action' => 'check_in',
                'shamous_tx_id' => 'SHM-TX-9481928',
                'status' => 'success',
                'synced_at' => now(),
            ]
        );

        // 8. Services / Outlets
        $services = [
            ['category' => 'cafe', 'name_en' => 'Arabic Coffee Dallah', 'name_ar' => '??? ???? ?????? ?????', 'price' => 35.00],
            ['category' => 'cafe', 'name_en' => 'Espresso / Cappuccino', 'name_ar' => '??????? / ????????', 'price' => 18.00],
            ['category' => 'laundry', 'name_en' => 'Thobe Dry Clean & Steam Press', 'name_ar' => '???? ???? ??? ???????', 'price' => 20.00],
            ['category' => 'restaurant', 'name_en' => 'Continental Breakfast Basket', 'name_ar' => '???? ????? ??????????', 'price' => 45.00],
        ];

        foreach ($services as $srv) {
            Service::updateOrCreate(
                ['property_id' => $property->id, 'name_en' => $srv['name_en']],
                [
                    'category' => $srv['category'],
                    'name_ar' => $srv['name_ar'],
                    'price' => $srv['price'],
                    'is_active' => true,
                ]
            );
        }

        // 9. Housekeeping Task
        HousekeepingTask::updateOrCreate(
            ['room_id' => $rooms[108]->id],
            [
                'property_id' => $property->id,
                'task_type' => 'checkout_cleaning',
                'priority' => 'urgent',
                'status' => 'in_progress',
                'assigned_staff' => 'Cleaning Crew A',
            ]
        );
    }
}