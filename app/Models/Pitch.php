<?php

namespace App\Models;

use Database\Factories\PitchFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pitch extends Model
{
    /** @use HasFactory<PitchFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'startup_name',
        'invested_amount',
        'monthly_net_value',
        'monthly_growth',
        'vision_statement',
        'additional_detail',
        'funding_required',
        'return_time',
        'total_valuation',
        'video_path',
        'status',
    ];

    public function pitchFields()
    {
        return $this->hasMany(PitchField::class);
    }
}
