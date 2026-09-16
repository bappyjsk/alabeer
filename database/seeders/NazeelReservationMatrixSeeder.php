<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;
use App\Models\RoomType;
use App\Models\Room;
use App\Models\Guest;
use App\Models\Reservation;
use App\Models\Folio;
use Carbon\Carbon;

class NazeelReservationMatrixSeeder extends Seeder
{
    public function run(): void
    {
        $property = Property::first() ?? Property::create([
            'code' => '1001',
            'name_en' => 'alabeer Furnished Suites - Branch 1001',
            'name_ar' => 'أجنحة العبير المفروشة - فرع 1001',
            'category' => 'furnished_apartments',
            'cr_number' => '1010849201',
            'vat_number' => '310293847500003',
            'shamous_hotel_id' => 'SHM-RUH-892',
            'city' => 'Tabuk',
            'currency' => 'SAR',
        ]);

        $vipType = RoomType::firstOrCreate(
            ['property_id' => $property->id, 'code' => 'VIP'],
            ['name_en' => 'VIP', 'name_ar' => 'VIP', 'base_price' => 650.00, 'max_adults' => 3, 'max_children' => 2]
        );

        $rwhType = RoomType::firstOrCreate(
            ['property_id' => $property->id, 'code' => 'RWH'],
            ['name_en' => 'Room with Hall', 'name_ar' => 'غرفة وصالة', 'base_price' => 450.00, 'max_adults' => 2, 'max_children' => 2]
        );

        $trwlType = RoomType::firstOrCreate(
            ['property_id' => $property->id, 'code' => 'TRWL'],
            ['name_en' => 'Two Rooms with...', 'name_ar' => 'غرفتين وصالة', 'base_price' => 750.00, 'max_adults' => 4, 'max_children' => 2]
        );

        $sglType = RoomType::firstOrCreate(
            ['property_id' => $property->id, 'code' => 'SGL'],
            ['name_en' => 'Single Room', 'name_ar' => 'غرفة مفردة', 'base_price' => 290.00, 'max_adults' => 1, 'max_children' => 1]
        );

        $today = Carbon::today();

        // 24 Units matching Nazeel (8 Vacant, 3 Rented/Due-out, 12 Check-out Today/Occupied, 1 Waiting Check-in)
        $units = [
            // Floor 2 (8 units)
            '201' => ['type' => $vipType, 'floor' => 2, 'status' => 'vacant_clean', 'guest' => null, 'balance' => 0],
            '202' => ['type' => $rwhType, 'floor' => 2, 'status' => 'vacant_clean', 'guest' => null, 'balance' => 0],
            '203' => ['type' => $rwhType, 'floor' => 2, 'status' => 'occupied', 'guest' => 'Ibrahim Al , Balawi', 'balance' => -2190],
            '204' => ['type' => $trwlType, 'floor' => 2, 'status' => 'occupied', 'guest' => null, 'balance' => 0], // Hovered card in screenshot
            '205' => ['type' => $vipType, 'floor' => 2, 'status' => 'occupied', 'guest' => 'Ali Al , Qarni', 'balance' => 0],
            '206' => ['type' => $sglType, 'floor' => 2, 'status' => 'occupied', 'guest' => 'albalawi dakhi...', 'balance' => 0],
            '207' => ['type' => $sglType, 'floor' => 2, 'status' => 'due_out', 'guest' => 'almalki mohamm...', 'balance' => 0],
            '208' => ['type' => $sglType, 'floor' => 2, 'status' => 'vacant_clean', 'guest' => null, 'balance' => 0],

            // Floor 3 (8 units)
            '301' => ['type' => $vipType, 'floor' => 3, 'status' => 'vacant_clean', 'guest' => null, 'balance' => 0],
            '302' => ['type' => $rwhType, 'floor' => 3, 'status' => 'vacant_clean', 'guest' => null, 'balance' => 0],
            '303' => ['type' => $rwhType, 'floor' => 3, 'status' => 'occupied', 'guest' => 'Talal Al-Huwaiti', 'balance' => 0],
            '304' => ['type' => $rwhType, 'floor' => 3, 'status' => 'occupied', 'guest' => 'Nayef Al , Balawi', 'balance' => 0],
            '305' => ['type' => $trwlType, 'floor' => 3, 'status' => 'vacant_clean', 'guest' => null, 'balance' => 0],
            '306' => ['type' => $vipType, 'floor' => 3, 'status' => 'occupied', 'guest' => 'Mashal Taher', 'balance' => 0],
            '307' => ['type' => $sglType, 'floor' => 3, 'status' => 'occupied', 'guest' => 'Rabi Al , Daraan', 'balance' => 0],
            '308' => ['type' => $rwhType, 'floor' => 3, 'status' => 'vacant_clean', 'guest' => null, 'balance' => 0],

            // Floor 4 (8 units)
            '401' => ['type' => $vipType, 'floor' => 4, 'status' => 'occupied', 'guest' => 'Muwafaq Khalidi', 'balance' => 0],
            '402' => ['type' => $rwhType, 'floor' => 4, 'status' => 'due_out', 'guest' => 'Bader Al , Otaibi', 'balance' => 0],
            '403' => ['type' => $rwhType, 'floor' => 4, 'status' => 'occupied', 'guest' => 'Major Al-Harbi', 'balance' => -140],
            '404' => ['type' => $rwhType, 'floor' => 4, 'status' => 'occupied', 'guest' => 'Abdullah Al , Juhani', 'balance' => -110],
            '405' => ['type' => $vipType, 'floor' => 4, 'status' => 'due_out', 'guest' => 'Sultan Al-Otaibi', 'balance' => 0],
            '406' => ['type' => $sglType, 'floor' => 4, 'status' => 'occupied', 'guest' => 'Fahad Al-Shehri', 'balance' => 0],
            '407' => ['type' => $sglType, 'floor' => 4, 'status' => 'occupied', 'guest' => 'Khaled Al-Mutairi', 'balance' => 0],
            '408' => ['type' => $trwlType, 'floor' => 4, 'status' => 'vacant_clean', 'guest' => null, 'balance' => 0],
        ];

        // Clean out legacy 101-110 and 209-210 so only the exact 24 Nazeel units exist
        Room::whereNotIn('room_number', array_keys($units))->delete();

        foreach ($units as $roomNo => $cfg) {
            $room = Room::updateOrCreate(
                ['property_id' => $property->id, 'room_number' => (string)$roomNo],
                [
                    'room_type_id' => $cfg['type']->id,
                    'floor' => $cfg['floor'],
                    'status' => $cfg['status'],
                    'smart_lock_id' => 'NZ-LCK-' . $roomNo,
                ]
            );

            if ($cfg['guest']) {
                $guest = Guest::firstOrCreate(
                    ['full_name_ar' => $cfg['guest']],
                    [
                        'first_name' => explode(' ', $cfg['guest'])[0] ?? 'Guest',
                        'last_name' => 'Al-Guest',
                        'id_number' => '10' . str_pad((string)abs(crc32($cfg['guest'])) % 100000000, 8, '1', STR_PAD_LEFT),
                        'id_type' => 'national_id',
                        'nationality' => 'SA',
                        'mobile_number' => '+9665' . str_pad((string)abs(crc32($cfg['guest'])) % 100000000, 8, '0', STR_PAD_LEFT),
                        'email' => 'guest.' . $roomNo . '@nazeel.local',
                    ]
                );

                $res = Reservation::updateOrCreate(
                    ['property_id' => $property->id, 'room_id' => $room->id, 'status' => 'checked_in'],
                    [
                        'reservation_no' => 'NZR-' . $roomNo . '-26',
                        'guest_id' => $guest->id,
                        'room_type_id' => $cfg['type']->id,
                        'check_in_date' => $today->copy()->subDays(1),
                        'check_out_date' => $today->copy()->addDays(2),
                        'adults' => 2,
                        'nightly_rate' => $cfg['type']->base_price,
                        'total_amount' => $cfg['type']->base_price * 3,
                        'paid_amount' => ($cfg['type']->base_price * 3) + $cfg['balance'],
                        'source' => 'direct',
                    ]
                );

                Folio::updateOrCreate(
                    ['reservation_id' => $res->id],
                    [
                        'folio_number' => 'FOL-' . $roomNo . '-' . date('Ymd'),
                        'guest_id' => $guest->id,
                        'property_id' => $property->id,
                        'total_charges' => $res->total_amount,
                        'total_payments' => $res->paid_amount,
                        'balance' => $cfg['balance'],
                        'status' => 'open',
                    ]
                );
            }
        }

        // Add 1 Waiting Check-in reservation
        $waitingGuest = Guest::firstOrCreate(
            ['full_name_ar' => 'Saad Al-Ghamdi'],
            [
                'first_name' => 'Saad',
                'last_name' => 'Al-Ghamdi',
                'id_number' => '1099887766',
                'id_type' => 'national_id',
                'nationality' => 'SA',
                'mobile_number' => '+966509988776',
                'email' => 'saad.ghamdi@nazeel.local',
            ]
        );
        $room201 = Room::where('room_number', '201')->first();
        if ($room201) {
            Reservation::updateOrCreate(
                ['reservation_no' => 'NZR-WAIT-001'],
                [
                    'property_id' => $property->id,
                    'room_id' => $room201->id,
                    'guest_id' => $waitingGuest->id,
                    'room_type_id' => $vipType->id,
                    'check_in_date' => $today,
                    'check_out_date' => $today->copy()->addDays(1),
                    'adults' => 1,
                    'nightly_rate' => 650.00,
                    'total_amount' => 650.00,
                    'paid_amount' => 650.00,
                    'status' => 'confirmed',
                    'source' => 'direct',
                ]
            );
        }
    }
}

