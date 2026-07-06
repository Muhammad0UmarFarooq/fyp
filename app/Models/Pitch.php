<?php

namespace App\Models;

use Database\Factories\PitchFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pitch extends Model
{
    /** @use HasFactory<PitchFactory> */
    use HasFactory;

    protected static function booted(): void
    {
        static::deleting(function (self $pitch): void {
            $pitch->agreements()->update(['pitch_id' => null]);
        });
    }

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function agreements()
    {
        return $this->hasMany(Agreement::class);
    }
}
