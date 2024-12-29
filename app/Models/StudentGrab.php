<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentGrab extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'deliverer_id',
        'phone_number',
        'pickup_address',
        'delivery_address',
        'date',
        'time',
        'status',
        'picked_up_at',
        'out_for_delivery_at',
        'delivered_at',
    ];

    /**
     * Relationship with the user who created the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship with the user who delivers the order.
     */
    public function deliverer()
    {
        return $this->belongsTo(User::class, 'deliverer_id');
    }
}
