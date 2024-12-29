<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentGrabsTable extends Migration
{
    public function up()
    {
        Schema::create('student_grabs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('deliverer_id')->nullable(); // Deliverer can be null initially
            $table->string('phone_number');
            $table->string('pickup_address');
            $table->string('delivery_address');
            $table->date('date')->nullable();// For selecting from a calendar
            $table->time('time')->nullable();; // Time of pickup/delivery
            $table->string('status')->default('pending'); // Status starts as pending
            $table->timestamp('picked_up_at')->nullable();
            $table->timestamp('out_for_delivery_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamps();

            // Add foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('deliverer_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_grabs');

        Schema::table('student_grabs', function (Blueprint $table) {
            // Drop date and time columns if rolling back
            $table->dropColumn(['date', 'time']);
        });
    }
}

