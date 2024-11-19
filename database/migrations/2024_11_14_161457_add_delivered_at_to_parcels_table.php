<?php

// database/migrations/xxxx_xx_xx_xxxxxx_add_delivered_at_to_parcels_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeliveredAtToParcelsTable extends Migration
{
    public function up()
    {
        Schema::table('parcels', function (Blueprint $table) {
            $table->timestamp('delivered_at')->nullable()->after('out_for_delivery_at');
        });
    }

    public function down()
    {
        Schema::table('parcels', function (Blueprint $table) {
            $table->dropColumn('delivered_at');
        });
    }
}

