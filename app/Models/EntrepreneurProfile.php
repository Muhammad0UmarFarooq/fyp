<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntrepreneurProfile extends Model
{
    protected $fillable = [
        'user_id',
        'company_name',
        'industry',
        'experience_years',
        'total_valuation',
        'future_valuation',
        'website',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
