<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agreement extends Model
{
    protected $fillable = [
        'offer_id',
        'pitch_id',
        'entrepreneur_id',
        'investor_id',
        'ownership_stake',
        'estimated_roi',
        'agreement_date',
        'status',
        'agreement_file',
        'agreement_filename',
        'agreement_filesize',
        'rejection_reason',
        'entrepreneur_file',
        'entrepreneur_filename',
        'entrepreneur_filesize',
    ];

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    public function pitch()
    {
        return $this->belongsTo(Pitch::class);
    }

    public function entrepreneur()
    {
        return $this->belongsTo(User::class, 'entrepreneur_id');
    }

    public function investor()
    {
        return $this->belongsTo(User::class, 'investor_id');
    }
}
