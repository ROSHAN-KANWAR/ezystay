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
            $table->string('booking_id')->unique()->default(0);
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->text('address')->nullable();
            $table->enum('document_type', ['passport', 'aadhar card', 'driver_license', 'other']);
            $table->string('document_number');
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->integer('no_of_nights');
            $table->foreignId('room_id')->constrained('rooms');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('advance_payment', 10, 2)->default(0);
            $table->decimal('net_amount', 10, 2);
            $table->enum('payment_status', ['online', 'cash', 'debit/credit card'])->default('online');
            $table->timestamps(); // created_at and updated_at
            $table->softDeletes(); // for deleted_at if needed
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
