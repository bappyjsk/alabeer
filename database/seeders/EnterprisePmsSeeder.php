<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EnterprisePmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $property = \App\Models\Property::first() ?? \App\Models\Property::create([
            'code' => '1001',
            'name_en' => 'alabeer Furnished Suites - Branch 1001',
            'name_ar' => 'أجنحة العبير المفروشة - فرع 1001',
            'category' => 'furnished_apartments',
            'cr_number' => '1010849201',
            'vat_number' => '310293847500003',
            'shamous_hotel_id' => 'SHM-RUH-892',
            'city' => 'Riyadh',
            'currency' => 'SAR',
        ]);

        $adminUser = \App\Models\User::first();
        $rooms = \App\Models\Room::where('property_id', $property->id)->get();
        $guests = \App\Models\Guest::all();
        $reservations = \App\Models\Reservation::all();

        // 1. Smart Lock Digital Keys
        if ($rooms->count() > 0 && $reservations->count() > 0) {
            \Illuminate\Support\Facades\DB::table('smart_lock_keys')->updateOrInsert(
                ['digital_key_token' => 'KEY-TOKEN-84920-A'],
                [
                    'room_id' => $rooms->first()->id,
                    'reservation_id' => $reservations->first()->id,
                    'user_id' => $adminUser?->id,
                    'key_type' => 'guest_pin',
                    'passcode_hash' => bcrypt('9281'),
                    'valid_from' => now()->startOfDay(),
                    'valid_until' => now()->addDays(2)->endOfDay(),
                    'status' => 'active',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        // 2. Guest Self-Service Portal Session
        if ($reservations->count() > 0) {
            \Illuminate\Support\Facades\DB::table('guest_portal_sessions')->updateOrInsert(
                ['access_token' => 'portal-tok-84920'],
                [
                    'reservation_id' => $reservations->first()->id,
                    'is_verified' => true,
                    'terms_accepted_at' => now(),
                    'verified_by' => $adminUser?->id,
                    'expires_at' => now()->addDays(3),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        // 3. Maintenance Tickets & SLAs
        \Illuminate\Support\Facades\DB::table('maintenance_tickets')->updateOrInsert(
            ['ticket_number' => 'MNT-2026-001'],
            [
                'property_id' => $property->id,
                'room_id' => $rooms->where('room_number', '210')->first()?->id ?? $rooms->first()?->id,
                'category' => 'ac_hvac',
                'priority' => 'high',
                'description' => 'Master bedroom split AC cooling coil inspection and thermostat replacement.',
                'status' => 'in_progress',
                'assigned_technician_id' => $adminUser?->id,
                'sla_due_at' => now()->addHours(4),
                'labor_cost' => 150.00,
                'material_cost' => 120.00,
                'total_cost' => 270.00,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // 4. Loyalty Tiers (Bronze -> Platinum)
        $tiers = [
            ['code' => 'BRONZE', 'name_en' => 'Bronze', 'name_ar' => 'برونزي', 'min_nights_threshold' => 0, 'min_spend_threshold' => 0, 'discount_pct' => 0.00, 'late_checkout_hours' => 0, 'points_multiplier' => 1.00],
            ['code' => 'SILVER', 'name_en' => 'Silver', 'name_ar' => 'فضي', 'min_nights_threshold' => 10, 'min_spend_threshold' => 3000, 'discount_pct' => 5.00, 'late_checkout_hours' => 1, 'points_multiplier' => 1.25],
            ['code' => 'GOLD', 'name_en' => 'Gold', 'name_ar' => 'ذهبي', 'min_nights_threshold' => 25, 'min_spend_threshold' => 8000, 'discount_pct' => 10.00, 'late_checkout_hours' => 2, 'points_multiplier' => 1.50],
            ['code' => 'PLATINUM', 'name_en' => 'Platinum', 'name_ar' => 'بلاتيني', 'min_nights_threshold' => 50, 'min_spend_threshold' => 20000, 'discount_pct' => 15.00, 'late_checkout_hours' => 3, 'points_multiplier' => 2.00],
        ];
        foreach ($tiers as $tier) {
            \Illuminate\Support\Facades\DB::table('loyalty_tiers')->updateOrInsert(['code' => $tier['code']], array_merge($tier, ['created_at' => now(), 'updated_at' => now()]));
        }

        // 5. Corporate Account & Direct B2B Contract
        \Illuminate\Support\Facades\DB::table('corporate_accounts')->updateOrInsert(
            ['contract_number' => 'CORP-SAUDI-ARAMCO-2026'],
            [
                'company_name_en' => 'Saudi Aramco Energy Services',
                'company_name_ar' => 'خدمات أرامكو السعودية للطاقة',
                'cr_number' => '2052101192',
                'vat_number' => '300021394800003',
                'credit_limit' => 150000.00,
                'current_outstanding_balance' => 14200.00,
                'payment_terms_days' => 30,
                'negotiated_discount_pct' => 20.00,
                'contract_start_date' => '2026-01-01',
                'contract_end_date' => '2026-12-31',
                'account_manager_user_id' => $adminUser?->id,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // 6. Omnichannel Unified Conversations (WhatsApp & SMS)
        if ($guests->count() > 0) {
            $convId = \Illuminate\Support\Facades\DB::table('guest_conversations')->insertGetId([
                'property_id' => $property->id,
                'guest_id' => $guests->first()->id,
                'reservation_id' => $reservations->first()?->id,
                'channel' => 'whatsapp',
                'channel_thread_id' => '+966501234567',
                'last_message_at' => now(),
                'unread_count' => 1,
                'status' => 'open',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            \Illuminate\Support\Facades\DB::table('guest_messages')->insert([
                [
                    'conversation_id' => $convId,
                    'sender_type' => 'guest',
                    'sender_user_id' => null,
                    'message_body' => 'Hello! Could we request an early check-in around 1:00 PM today?',
                    'delivery_status' => 'read',
                    'sent_at' => now()->subMinutes(15),
                    'created_at' => now()->subMinutes(15),
                    'updated_at' => now()->subMinutes(15),
                ],
                [
                    'conversation_id' => $convId,
                    'sender_type' => 'bot_ai',
                    'sender_user_id' => null,
                    'message_body' => 'Marhaban Faisal! Your Executive Suite 101 is already inspected and vacant clean. Your smart PIN 9281 will activate at 1:00 PM.',
                    'delivery_status' => 'delivered',
                    'sent_at' => now()->subMinutes(12),
                    'created_at' => now()->subMinutes(12),
                    'updated_at' => now()->subMinutes(12),
                ]
            ]);
        }

        // 7. AI Dynamic Pricing & Yield Recommendation
        $roomTypes = \App\Models\RoomType::where('property_id', $property->id)->get();
        if ($roomTypes->count() > 0) {
            \Illuminate\Support\Facades\DB::table('ai_rate_recommendations')->updateOrInsert(
                ['property_id' => $property->id, 'room_type_id' => $roomTypes->first()->id, 'target_date' => now()->toDateString()],
                [
                    'current_rate' => $roomTypes->first()->base_price,
                    'recommended_rate' => round($roomTypes->first()->base_price * 1.18, 2),
                    'projected_occupancy_pct' => 88.50,
                    'competitor_avg_rate' => round($roomTypes->first()->base_price * 1.25, 2),
                    'demand_factor_score' => 1.22,
                    'rationale' => 'High regional demand surge detected in North Riyadh. Area occupancy at 91%. Recommendation to adjust rate +18% to maximize RevPAR.',
                    'status' => 'pending',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        // 8. Automated Anomaly Detection Alert
        \Illuminate\Support\Facades\DB::table('anomaly_alerts')->updateOrInsert(
            ['property_id' => $property->id, 'description' => 'Unusual rate override detected: Manual 45% discount applied on weekend booking.'],
            [
                'category' => 'unusual_discount',
                'severity' => 'high',
                'entity_type' => 'reservation',
                'entity_id' => $reservations->first()?->id ?? 1,
                'suggested_action' => 'Require Duty Manager PIN approval or verify corporate contract code.',
                'status' => 'open',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // 9. Workflow Automation Engine Rule
        \Illuminate\Support\Facades\DB::table('workflow_rules')->updateOrInsert(
            ['rule_name' => 'VIP Arrival Smart Alert & Welcome Dallah'],
            [
                'property_id' => $property->id,
                'event_trigger' => 'reservation.check_in',
                'conditions_json' => json_encode(['guest_is_vip' => true]),
                'actions_json' => json_encode([
                    ['action' => 'send_whatsapp', 'template' => 'vip_welcome_ar'],
                    ['action' => 'notify_duty_manager', 'priority' => 'high'],
                    ['action' => 'create_service_order', 'item' => 'Arabic Coffee Dallah']
                ]),
                'is_enabled' => true,
                'execution_count' => 14,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
