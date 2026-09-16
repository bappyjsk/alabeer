<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
    public function test_the_application_redirects_home_to_login(): void
    {
        $response = $this->get('/');
        $response->assertRedirect('/login');
    }

    public function test_login_page_renders_successfully(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Welcome to');
        $response->assertSee('User Name');
        $response->assertSee('Access Code');
        $response->assertSee('login_illustration.png');
        $response->assertSee('Smart Hotel &amp; Apartment Management', false);
        $response->assertSee('SHOMOUS Certified');
        $response->assertDontSee('Cloud Hospitality OS');
        $response->assertDontSee('reCAPTCHA');
        $response->assertSee('btnThemeToggle');
    }

    public function test_user_can_authenticate_and_access_dashboard(): void
    {
        $user = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login', [
            'login' => 'admin@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticated();

        // Check Dashboard renders with Enterprise intelligence and PMS components
        $dashResponse = $this->actingAs($user)->get('/dashboard');
        $dashResponse->assertStatus(200);
        $dashResponse->assertSee('Unit Status Matrix');
        $dashResponse->assertSee('Reservations Balances');
        $dashResponse->assertSee('Drawer Balance');
        $dashResponse->assertSee('txtArrivalsTitle');
        $dashResponse->assertSee('Developed by IT Team');
        $dashResponse->assertSee('btnDashboardThemeToggle');
        $dashResponse->assertSee('modalPropertyCompliance');
        $dashResponse->assertSee('Confirm Address, Commercial Information &amp; Location', false);
        $dashResponse->assertSee('Detect Current Location');
        $dashResponse->assertSee('txtNavPropertyLocation');

        // Test Logout
        $logoutResponse = $this->post('/logout');
        $logoutResponse->assertRedirect('/login');
        $this->assertGuest();
    }

    public function test_user_can_access_reservations_page(): void
    {
        $user = User::create([
            'name' => 'Radwan Accountant',
            'email' => 'radwan@nazeel.local',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->actingAs($user)->get('/reservations');
        $response->assertStatus(200);
        $response->assertSee('Reservations');
        $response->assertSee('You can see and manage the reservations');
        $response->assertSee('Filter');
        $response->assertSee('+ New Reservation');
        $response->assertSee('Vacant');
        $response->assertSee('Rented');
        $response->assertSee('Waiting Check-In');
        $response->assertSee('Check-Out Today');
        $response->assertSee('modalNewReservation');
        $response->assertSee('modalUnitDetails');
        $response->assertSee('popSupportChatTicket');
        $response->assertSee('navKsaTime');
        $response->assertSee('navBdTime');
    }
}
