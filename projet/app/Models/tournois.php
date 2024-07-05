<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tournois extends Model
{
    use HasFactory;

    protected $table = 'tournois';

    protected $fillable = [
        'tournamentname', 'stadiumname', 'date', 'price', 'prize'
    ];
}
