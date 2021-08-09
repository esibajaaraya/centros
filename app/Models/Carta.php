<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carta extends Model
{
    protected $table = 'cartas';

    public function barajacarta() {
        return $this->hasMany('App\Models\BarajaCarta');
    }
}
