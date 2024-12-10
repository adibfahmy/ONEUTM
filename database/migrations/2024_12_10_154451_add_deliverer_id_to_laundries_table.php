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
        Schema::table('laundries', function (Blueprint $table) {
            $table->unsignedBigInteger('deliverer_id')->nullable()->after('user_id');
            $table->timestamp('picked_up_at')->nullable()->after('deliverer_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laundries', function (Blueprint $table) {
            $table->dropColumn('deliverer_id');
            $table->dropColumn('picked_up_at');
        });
    }
};
