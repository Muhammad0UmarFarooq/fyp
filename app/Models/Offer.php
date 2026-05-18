<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
        'pitch_id',
        'investor_id',
        'offer_amount',
        'time_period',
        'valuation',
        'status',
    ];

    public function pitch()
    {
        return $this->belongsTo(Pitch::class);
    }

    public function investor()
    {
        return $this->belongsTo(User::class, 'investor_id');
    }
}
