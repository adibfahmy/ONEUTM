<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laundry extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'deliverer_id',
        'pickup_address',
        'phone_number',
        'delivery_address',
        'status',
        'picked_up_at',
        'out_for_delivery_at',
        'delivered_at',
    ];

    protected $dates = [
        'picked_up_at',
        'out_for_delivery_at',
        'delivered_at',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function deliverer()
    {
        return $this->belongsTo(User::class, 'deliverer_id');
    }
}
