<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParcelsTable extends Migration
{
    public function up()
    {
        Schema::create('parcels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string(column: 'tracking_number')->unique();
            $table->enum('pickup_point', ['Cengal Parcel Point', 'One Parcel Centre', 'Angkasa Ninja Van']);
            $table->string('phone_number');
            $table->string('delivery_address');
            $table->enum('status', allowed: ['pending', 'picked_up', 'out_for_delivery', 'delivered'])->default('pending');
            $table->timestamps();
            // Add any additional fields here as necessary
        });
    }

    public function down()
    {
        Schema::dropIfExists('parcels');
    }
}
