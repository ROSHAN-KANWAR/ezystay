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
    $table->foreignId('room_id')->constrained();
    $table->string('guest_name');
    $table->string('guest_email');
    $table->string('guest_phone');
    $table->date('check_in');
    $table->date('check_out');
    $table->integer('total_nights');
    $table->decimal('room_rate', 10, 2);
    $table->decimal('subtotal', 10, 2);
    $table->decimal('discount', 10, 2)->default(0);
    $table->decimal('tax', 10, 2)->default(0);
    $table->decimal('total_amount', 10, 2);
    $table->decimal('advance_payment', 10, 2)->default(0);
    $table->string('payment_status')->default('pending');
    $table->text('special_requests')->nullable();
    $table->timestamps();
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
