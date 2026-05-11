<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvestorProfile extends Model
{
    protected $fillable = [
        'user_id',
        'interested_businesses',
        'investment_amount',
        'investment_focus',
        'portfolio_size',
    ];

    protected $casts = [
        'interested_businesses' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
