<?php

namespace App\Models;

use Database\Factories\PitchFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pitch extends Model
{
    /** @use HasFactory<PitchFactory> */
    use HasFactory;
}
