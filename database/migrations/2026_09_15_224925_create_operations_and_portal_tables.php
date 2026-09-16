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
        // 1. Digital Smart Lock Keys
        Schema::create('smart_lock_keys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained()->cascadeOnDelete();
            $table->foreignId('reservation_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('key_type')->default('guest_pin'); // guest_pin, guest_mobile, staff_pass, emergency_override
            $table->string('passcode_hash')->nullable();
            $table->string('digital_key_token')->unique();
            $table->dateTime('valid_from');
            $table->dateTime('valid_until');
            $table->string('status')->default('active'); // active, expired, revoked
            $table->string('revoked_reason')->nullable();
            $table->timestamps();

            $table->index(['reservation_id', 'status']);
            $table->index(['valid_until']);
        });

        // 2. Guest Self-Service Portal & Digital Check-in
        Schema::create('guest_portal_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->constrained()->cascadeOnDelete();
            $table->string('access_token', 100)->unique();
            $table->string('id_document_path')->nullable();
            $table->string('id_selfie_path')->nullable();
            $table->text('signature_svg')->nullable();
            $table->dateTime('terms_accepted_at')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete();
            $table->dateTime('expires_at');
            $table->timestamps();
        });

        // 3. Maintenance Tickets & SLAs
        Schema::create('maintenance_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_number', 50)->unique();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->foreignId('room_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('guest_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('reported_by_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('category')->default('plumbing');
            $table->string('priority')->default('medium');
            $table->text('description');
            $table->json('photo_urls')->nullable();
            $table->string('status')->default('open');
            $table->foreignId('assigned_technician_id')->nullable()->constrained('users')->nullOnDelete();
            $table->dateTime('sla_due_at')->nullable();
            $table->dateTime('resolved_at')->nullable();
            $table->decimal('labor_cost', 10, 2)->default(0.00);
            $table->decimal('material_cost', 10, 2)->default(0.00);
            $table->decimal('total_cost', 10, 2)->default(0.00);
            $table->timestamps();

            $table->index(['property_id', 'status', 'priority']);
        });

        // 4. Maintenance Parts
        Schema::create('maintenance_parts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id')->constrained('maintenance_tickets')->cascadeOnDelete();
            $table->string('part_name');
            $table->integer('quantity')->default(1);
            $table->decimal('unit_cost', 10, 2);
            $table->decimal('total_cost', 10, 2);
            $table->string('supplier')->nullable();
            $table->timestamps();
        });

        // 5. Lost & Found
        Schema::create('lost_and_found', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->foreignId('room_id')->nullable()->constrained()->nullOnDelete();
            $table->text('item_description');
            $table->string('photo_url')->nullable();
            $table->foreignId('found_by_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->date('found_date');
            $table->string('storage_bin')->nullable();
            $table->string('status')->default('stored');
            $table->foreignId('claimed_by_guest_id')->nullable()->constrained('guests')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lost_and_found');
        Schema::dropIfExists('maintenance_parts');
        Schema::dropIfExists('maintenance_tickets');
        Schema::dropIfExists('guest_portal_sessions');
        Schema::dropIfExists('smart_lock_keys');
    }
};
