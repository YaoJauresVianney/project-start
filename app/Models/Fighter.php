<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fighter extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'title',
        'location',
        'pay_per_view',
        'date',
        'hour'
    ];
}
