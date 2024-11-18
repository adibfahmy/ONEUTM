<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Parcel extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'deliverer_id',
        'name',
        'tracking_number',
        'pickup_point',
        'phone_number',
        'delivery_address',
        'status',
        'picked_up_at',
        'out_for_delivery_at',
        'delivered_at',
    ];

    protected $casts = [
        'picked_up_at' => 'datetime',
        'out_for_delivery_at' => 'datetime',
        'delivered_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function deliverer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'deliverer_id');
    }
}
