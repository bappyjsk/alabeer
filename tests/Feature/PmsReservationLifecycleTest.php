<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Property;
use App\Models\RoomType;
use App\Models\Room;
use App\Models\Guest;
use App\Models\Reservation;
use Carbon\Carbon;

class PmsReservationLifecycleTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected Property $property;
    protected RoomType $roomType;
    protected Room $room;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password123'),
        ]);

        $this->property = Property::create([
            'name_en' => 'alabeer Furnished Suites',
            'name_ar' => 'أجنحة العبير المفروشة',
            'code' => '1001',
            'category' => 'furnished_apartments',
            'cr_number' => '1010849201',
            'vat_number' => '310293847500003',
            'shamous_hotel_id' => 'SHM-RUH-892',
            'city' => 'Riyadh',
            'currency' => 'SAR',
        ]);

        $this->roomType = RoomType::create([
            'property_id' => $this->property->id,
            'name_en' => 'Executive Suite',
            'name_ar' => 'جناح تنفيذي',
            'code' => 'EXEC',
            'base_price' => 500.00,
            'max_adults' => 2,
        ]);

        $this->room = Room::create([
            'property_id' => $this->property->id,
            'room_type_id' => $this->roomType->id,
            'room_number' => '101',
            'floor' => 1,
            'status' => 'vacant_clean',
        ]);
    }

    public function test_authenticated_user_can_access_dashboard_with_pms_data(): void
    {
        $response = $this->actingAs($this->user)->get('/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Unit Status Matrix');
        $response->assertSee('101');
    }

    public function test_can_create_new_reservation_and_assign_room(): void
    {
        $response = $this->actingAs($this->user)->post('/reservations', [
            'first_name' => 'Saud',
            'last_name' => 'Al-Otaibi',
            'id_number' => '1082910293',
            'mobile_number' => '+966501234567',
            'room_type_id' => $this->roomType->id,
            'room_id' => $this->room->id,
            'check_in_date' => Carbon::today()->format('Y-m-d'),
            'check_out_date' => Carbon::today()->addDays(3)->format('Y-m-d'),
            'paid_amount' => 1500.00,
            'payment_method' => 'mada',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertDatabaseHas('reservations', [
            'guest_id' => Guest::where('id_number', '1082910293')->first()->id,
            'status' => 'confirmed',
        ]);
        $this->assertDatabaseHas('rooms', [
            'id' => $this->room->id,
            'status' => 'reserved',
        ]);
    }

    public function test_can_check_in_and_check_out_reservation(): void
    {
        $guest = Guest::create([
            'first_name' => 'Turki',
            'last_name' => 'Al-Hamad',
            'id_number' => '1099887766',
            'mobile_number' => '+966555112233',
        ]);

        $reservation = Reservation::create([
            'reservation_no' => 'NZ-99999',
            'property_id' => $this->property->id,
            'guest_id' => $guest->id,
            'room_id' => $this->room->id,
            'room_type_id' => $this->roomType->id,
            'check_in_date' => Carbon::today(),
            'check_out_date' => Carbon::today()->addDays(2),
            'nightly_rate' => 500.00,
            'status' => 'confirmed',
            'total_amount' => 1000.00,
            'paid_amount' => 1000.00,
        ]);

        // 1. Perform Check In
        $checkInRes = $this->actingAs($this->user)->post("/reservations/{$reservation->id}/check-in");
        $checkInRes->assertRedirect('/dashboard');
        
        $this->assertEquals('checked_in', $reservation->fresh()->status);
        $this->assertEquals('occupied', $this->room->fresh()->status);

        // 2. Perform Check Out
        $checkOutRes = $this->actingAs($this->user)->post("/reservations/{$reservation->id}/check-out");
        $checkOutRes->assertRedirect('/dashboard');

        $this->assertEquals('checked_out', $reservation->fresh()->status);
        $this->assertEquals('vacant_dirty', $this->room->fresh()->status);
    }

    public function test_can_update_room_status_directly(): void
    {
        $response = $this->actingAs($this->user)->post("/rooms/{$this->room->id}/status", [
            'status' => 'maintenance',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertEquals('maintenance', $this->room->fresh()->status);
    }
}
