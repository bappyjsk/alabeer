<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Chart of Accounts & General Ledger
        Schema::create('chart_of_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('account_code', 30)->unique();
            $table->string('account_name');
            $table->string('account_type'); // asset, liability, equity, revenue, expense
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 2. Cashier Shift Closing & Drawer Variance
        Schema::create('cashier_shifts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('shift_code', 30); // morning, evening, night
            $table->decimal('opening_cash_balance', 10, 2);
            $table->decimal('expected_cash_balance', 10, 2)->default(0.00);
            $table->decimal('actual_cash_counted', 10, 2)->nullable();
            $table->decimal('variance', 10, 2)->nullable();
            $table->dateTime('opened_at');
            $table->dateTime('closed_at')->nullable();
            $table->string('status')->default('open'); // open, closed, verified
            $table->text('supervisor_notes')->nullable();
            $table->timestamps();
        });

        // 3. AI Dynamic Pricing & Yield Recommendations
        Schema::create('ai_rate_recommendations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->foreignId('room_type_id')->constrained()->cascadeOnDelete();
            $table->date('target_date');
            $table->decimal('current_rate', 10, 2);
            $table->decimal('recommended_rate', 10, 2);
            $table->decimal('projected_occupancy_pct', 5, 2);
            $table->decimal('competitor_avg_rate', 10, 2)->nullable();
            $table->decimal('demand_factor_score', 4, 2)->default(1.00);
            $table->text('rationale');
            $table->string('status')->default('pending'); // pending, approved, rejected, auto_applied
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index(['property_id', 'target_date', 'status']);
        });

        // 4. Channel Manager Connections & Sync Logs (with Idempotency)
        Schema::create('channel_connections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->string('channel_name'); // booking_com, agoda, expedia, airbnb
            $table->string('hotel_id_on_channel');
            $table->text('api_token')->nullable();
            $table->boolean('is_active')->default(true);
            $table->dateTime('last_sync_at')->nullable();
            $table->timestamps();
        });

        Schema::create('channel_sync_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('channel_connection_id')->constrained('channel_connections')->cascadeOnDelete();
            $table->string('idempotency_key', 100)->unique();
            $table->string('action_type'); // inventory_push, rate_push, booking_inbound
            $table->json('payload')->nullable();
            $table->integer('response_code')->default(200);
            $table->string('status')->default('success'); // success, failed
            $table->timestamps();
        });

        // 5. Automated Anomaly Detection & Fraud Watch
        Schema::create('anomaly_alerts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->string('category'); // unusual_discount, duplicate_booking, suspicious_refund, rate_leakage
            $table->string('severity')->default('medium'); // low, medium, high, critical
            $table->string('entity_type'); // reservation, payment, room_rate
            $table->unsignedBigInteger('entity_id');
            $table->text('description');
            $table->string('suggested_action');
            $table->string('status')->default('open'); // open, investigating, resolved, false_positive
            $table->foreignId('acknowledged_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index(['property_id', 'status', 'severity']);
        });

        // 6. Workflow Automation Engine Rules
        Schema::create('workflow_rules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->string('rule_name');
            $table->string('event_trigger'); // reservation.created, guest.checked_out, maintenance.emergency
            $table->json('conditions_json')->nullable();
            $table->json('actions_json')->nullable();
            $table->boolean('is_enabled')->default(true);
            $table->integer('execution_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workflow_rules');
        Schema::dropIfExists('anomaly_alerts');
        Schema::dropIfExists('channel_sync_logs');
        Schema::dropIfExists('channel_connections');
        Schema::dropIfExists('ai_rate_recommendations');
        Schema::dropIfExists('cashier_shifts');
        Schema::dropIfExists('chart_of_accounts');
    }
};
