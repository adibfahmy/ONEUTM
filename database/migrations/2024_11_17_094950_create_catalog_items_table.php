<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_items', function (Blueprint $table) {
            $table->id(); // Primary key auto-incrementing
            $table->string('name'); // Item name
            $table->text('description'); // Item description
            $table->string('image_url'); // Image URL of the item
            $table->decimal('price', 8, 2); // Price of the item (up to 999999.99)
            $table->timestamps(); // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalog_items'); // Drop the table if rolling back
    }
}
