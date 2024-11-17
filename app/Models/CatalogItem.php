<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogItem extends Model
{
    use HasFactory;

    // Defining the attributes that can be mass assigned
    protected $fillable = ['name', 'description', 'image_url', 'price'];
}
