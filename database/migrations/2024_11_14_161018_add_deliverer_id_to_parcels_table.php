<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDelivererIdToParcelsTable extends Migration
{
    public function up()
    {
        Schema::table('parcels', function (Blueprint $table) {
            $table->unsignedBigInteger('deliverer_id')->nullable()->after('user_id');
            $table->timestamp('picked_up_at')->nullable()->after('deliverer_id');
        });
    }

    public function down()
    {
        Schema::table('parcels', function (Blueprint $table) {
            $table->dropColumn('deliverer_id');
            $table->dropColumn('picked_up_at');
        });
    }
}
