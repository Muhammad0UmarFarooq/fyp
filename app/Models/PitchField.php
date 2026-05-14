<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PitchField extends Model
{
    protected $fillable = [
        'pitch_id',
        'label',
        'value',
    ];

    public function pitch()
    {
        return $this->belongsTo(Pitch::class);
    }
}
