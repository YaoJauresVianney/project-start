<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fight extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'event_id',
        'fighter_one_id',
        'fighter_two_id',
        'number_of_rounds',
        'for_title',
        'method',
        'last_round',
        'duration',
        'winner_id'
    ];
}
