<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_id')->unique();
            
            // Guest information
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->text('address')->nullable();
            
            // ID Proof (as per Indian hotel regulations)
            $table->enum('document_type', ['passport', 'aadhar_card', 'driver_license', 'voter_id', 'pan_card', 'other']);
            $table->string('document_number');
           
            // Stay details
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->integer('no_of_nights')->default(0);
            $table->time('expected_checkin_time')->nullable();
            
            // Guest counts
            $table->integer('no_of_adults')->default(0);
            $table->integer('no_of_children')->default(0);   
            $table->integer('total_on_guest')->default(0);
            
            // Room assignment
            $table->foreignId('room_id')->constrained('rooms');
            
            // Company booking details (for corporate bookings)
            $table->string('company_name')->nullable();
            $table->text('company_address')->nullable();
            $table->string('company_website')->nullable();
            $table->string('company_degignation')->nullable();
            
            // Financials
            $table->decimal('subtotal', 10, 2);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('tax_amount', 10, 2)->default(0); // GST
            $table->decimal('extra_charges', 10, 2)->default(0);
            $table->decimal('advance_payment', 10, 2)->default(0);
            $table->decimal('net_amount', 10, 2);
            
            // Payment details
            $table->enum('payment_status', ['pending', 'partial', 'paid', 'refunded'])->default('pending');
            $table->enum('payment_method', ['online', 'cash', 'debit_card', 'credit_card', 'upi', 'bank_transfer'])->default('online');
            
            
            // Booking status
            $table->enum('status', ['checked_in', 'checked_out', 'cancelled', 'no_show'])->default('checked_in');
            
            // Additional fields
            $table->text('special_requests')->nullable();
            $table->string('purpose_of_visit')->nullable(); // business, leisure, etc.
           
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};
