<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Properties
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('name_en');
            $table->string('name_ar');
            $table->string('code')->unique(); // e.g. 1001
            $table->string('category')->default('furnished_apartments');
            $table->string('cr_number')->nullable();
            $table->string('vat_number')->nullable();
            $table->string('shamous_hotel_id')->nullable();
            $table->string('city')->default('Riyadh');
            $table->string('currency')->default('SAR');
            $table->timestamps();
        });

        // 2. Room Types
        Schema::create('room_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->string('code'); // e.g. EXEC, STD, SUITE_1B
            $table->string('name_en');
            $table->string('name_ar');
            $table->decimal('base_price', 10, 2)->default(300.00);
            $table->integer('max_adults')->default(2);
            $table->integer('max_children')->default(1);
            $table->timestamps();
        });

        // 3. Rooms / Units
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->foreignId('room_type_id')->constrained()->cascadeOnDelete();
            $table->string('room_number'); // e.g. 101, 102
            $table->integer('floor')->default(1);
            $table->string('status')->default('vacant_clean'); // vacant_clean, vacant_dirty, occupied, due_out, reserved, maintenance
            $table->string('smart_lock_id')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->unique(['property_id', 'room_number']);
        });

        // 4. Guests
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('full_name_ar')->nullable();
            $table->string('id_type')->default('national_id'); // national_id, iqama, passport, gcc_id
            $table->string('id_number')->index();
            $table->string('nationality')->default('SA');
            $table->string('mobile_number');
            $table->string('email')->nullable();
            $table->boolean('is_vip')->default(false);
            $table->boolean('is_blacklisted')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // 5. Reservations
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('reservation_no')->unique(); // e.g. NZ-84920
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->foreignId('guest_id')->constrained()->cascadeOnDelete();
            $table->foreignId('room_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('room_type_id')->constrained()->cascadeOnDelete();
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->dateTime('actual_check_in_at')->nullable();
            $table->dateTime('actual_check_out_at')->nullable();
            $table->integer('adults')->default(1);
            $table->integer('children')->default(0);
            $table->decimal('nightly_rate', 10, 2);
            $table->decimal('total_amount', 10, 2);
            $table->decimal('paid_amount', 10, 2)->default(0.00);
            $table->string('status')->default('confirmed'); // confirmed, checked_in, checked_out, cancelled
            $table->string('source')->default('walk_in'); // walk_in, direct, ota, booking_com
            $table->text('special_requests')->nullable();
            $table->timestamps();
        });

        // 6. Folios (Billing)
        Schema::create('folios', function (Blueprint $table) {
            $table->id();
            $table->string('folio_number')->unique();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->foreignId('reservation_id')->constrained()->cascadeOnDelete();
            $table->foreignId('guest_id')->constrained()->cascadeOnDelete();
            $table->decimal('total_charges', 10, 2)->default(0.00);
            $table->decimal('total_payments', 10, 2)->default(0.00);
            $table->decimal('balance', 10, 2)->default(0.00);
            $table->string('status')->default('open'); // open, settled, closed
            $table->dateTime('closed_at')->nullable();
            $table->timestamps();
        });

        // 7. Folio Items
        Schema::create('folio_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('folio_id')->constrained()->cascadeOnDelete();
            $table->string('category'); // room_charge, cafe, laundry, fee, vat
            $table->string('description');
            $table->decimal('unit_price', 10, 2);
            $table->integer('quantity')->default(1);
            $table->decimal('tax_rate', 5, 2)->default(15.00); // 15% VAT in Saudi
            $table->decimal('tax_amount', 10, 2)->default(0.00);
            $table->decimal('total_amount', 10, 2);
            $table->timestamps();
        });

        // 8. Payments
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('folio_id')->constrained()->cascadeOnDelete();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->string('payment_number')->unique();
            $table->decimal('amount', 10, 2);
            $table->string('payment_method'); // mada, cash, visa_mastercard, bank_transfer
            $table->string('transaction_ref')->nullable();
            $table->boolean('is_refund')->default(false);
            $table->dateTime('paid_at');
            $table->timestamps();
        });

        // 9. Services / Outlets
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->string('category'); // cafe, laundry, restaurant, minibar
            $table->string('name_en');
            $table->string('name_ar');
            $table->decimal('price', 10, 2);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 10. Housekeeping Tasks
        Schema::create('housekeeping_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->foreignId('room_id')->constrained()->cascadeOnDelete();
            $table->string('task_type')->default('daily_cleaning'); // daily_cleaning, checkout_cleaning, deep_cleaning, maintenance
            $table->string('priority')->default('normal'); // low, normal, urgent
            $table->string('status')->default('pending'); // pending, in_progress, inspected, completed
            $table->string('assigned_staff')->nullable();
            $table->dateTime('completed_at')->nullable();
            $table->timestamps();
        });

        // 11. Shomoos Integration Transactions
        Schema::create('shomoos_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->foreignId('reservation_id')->constrained()->cascadeOnDelete();
            $table->string('action'); // check_in, check_out, cancel
            $table->string('shamous_tx_id')->nullable();
            $table->string('status')->default('pending'); // pending, success, failed
            $table->text('error_message')->nullable();
            $table->dateTime('synced_at')->nullable();
            $table->timestamps();
        });

        // 12. ZATCA E-Invoices
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->foreignId('folio_id')->constrained()->cascadeOnDelete();
            $table->string('invoice_number')->unique();
            $table->string('invoice_uuid')->unique();
            $table->decimal('subtotal', 10, 2);
            $table->decimal('tax_amount', 10, 2);
            $table->decimal('grand_total', 10, 2);
            $table->text('qr_code')->nullable();
            $table->string('zatca_status')->default('cleared'); // cleared, reported, pending
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
        Schema::dropIfExists('shomoos_transactions');
        Schema::dropIfExists('housekeeping_tasks');
        Schema::dropIfExists('services');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('folio_items');
        Schema::dropIfExists('folios');
        Schema::dropIfExists('reservations');
        Schema::dropIfExists('guests');
        Schema::dropIfExists('rooms');
        Schema::dropIfExists('room_types');
        Schema::dropIfExists('properties');
    }
};