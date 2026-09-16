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
        // 1. Loyalty Tiers (Bronze, Silver, Gold, Platinum)
        Schema::create('loyalty_tiers', function (Blueprint $table) {
            $table->id();
            $table->string('code', 30)->unique();
            $table->string('name_en', 50);
            $table->string('name_ar', 50);
            $table->integer('min_nights_threshold')->default(0);
            $table->decimal('min_spend_threshold', 10, 2)->default(0.00);
            $table->decimal('discount_pct', 4, 2)->default(0.00);
            $table->boolean('free_upgrade_eligible')->default(false);
            $table->integer('late_checkout_hours')->default(0);
            $table->decimal('points_multiplier', 3, 2)->default(1.00);
            $table->timestamps();
        });

        // 2. Corporate Accounts & B2B Contracts
        Schema::create('corporate_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('company_name_en');
            $table->string('company_name_ar')->nullable();
            $table->string('cr_number', 50)->nullable();
            $table->string('vat_number', 50)->nullable();
            $table->string('contract_number', 50)->unique();
            $table->decimal('credit_limit', 12, 2)->default(50000.00);
            $table->decimal('current_outstanding_balance', 12, 2)->default(0.00);
            $table->integer('payment_terms_days')->default(30);
            $table->decimal('negotiated_discount_pct', 4, 2)->default(15.00);
            $table->date('contract_start_date');
            $table->date('contract_end_date');
            $table->foreignId('account_manager_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status')->default('active'); // active, suspended, expired
            $table->timestamps();
        });

        // 3. Guest 360 Profiles
        Schema::create('guest_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guest_id')->unique()->constrained()->cascadeOnDelete();
            $table->foreignId('loyalty_tier_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('corporate_id')->nullable()->constrained('corporate_accounts')->nullOnDelete();
            $table->decimal('total_spent_lifetime', 12, 2)->default(0.00);
            $table->integer('total_nights_stayed')->default(0);
            $table->integer('total_stays_count')->default(0);
            $table->integer('loyalty_points_balance')->default(0);
            $table->string('preferred_floor')->default('any');
            $table->string('pillow_preference')->nullable();
            $table->text('dietary_notes')->nullable();
            $table->boolean('do_not_disturb_frequent')->default(false);
            $table->timestamps();
        });

        // 4. Loyalty Ledger Transactions
        Schema::create('loyalty_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guest_id')->constrained()->cascadeOnDelete();
            $table->foreignId('reservation_id')->nullable()->constrained()->nullOnDelete();
            $table->string('type'); // earned, redeemed, expired, bonus_adjustment
            $table->integer('points');
            $table->integer('balance_after');
            $table->string('description');
            $table->timestamps();
        });

        // 5. Unified Omnichannel Conversations
        Schema::create('guest_conversations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->foreignId('guest_id')->constrained()->cascadeOnDelete();
            $table->foreignId('reservation_id')->nullable()->constrained()->nullOnDelete();
            $table->string('channel')->default('whatsapp'); // whatsapp, sms, email, web_chat, ota_booking
            $table->string('channel_thread_id')->nullable();
            $table->dateTime('last_message_at');
            $table->integer('unread_count')->default(0);
            $table->string('status')->default('open'); // open, pending_staff, resolved, automated
            $table->timestamps();

            $table->index(['property_id', 'status']);
        });

        // 6. Unified Messages
        Schema::create('guest_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conversation_id')->constrained('guest_conversations')->cascadeOnDelete();
            $table->string('sender_type'); // guest, staff, bot_ai, system_event
            $table->foreignId('sender_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->text('message_body');
            $table->string('media_url')->nullable();
            $table->string('delivery_status')->default('queued'); // queued, sent, delivered, read, failed
            $table->text('error_message')->nullable();
            $table->dateTime('sent_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guest_messages');
        Schema::dropIfExists('guest_conversations');
        Schema::dropIfExists('loyalty_transactions');
        Schema::dropIfExists('guest_profiles');
        Schema::dropIfExists('corporate_accounts');
        Schema::dropIfExists('loyalty_tiers');
    }
};
