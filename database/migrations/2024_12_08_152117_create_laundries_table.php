<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatelaundriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laundries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('pickup_address');
            $table->string('delivery_address');
            $table->string('phone_number');
            $table->enum('status', allowed: ['pending', 'picked_up', 'out_for_delivery', 'delivered'])->default('pending');
            $table->timestamp('pickup_time')->nullable();
            $table->timestamps();

            // Add foreign key constraint if users table exists
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laundries');
    }
}
