<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarajaCarta extends Model
{
    protected $table = 'barajas_cartas';

    public function carta() {
        return $this->belongsTo('App\Models\Carta', 'carta_id');
    }

    public function palo() {
        return $this->belongsTo('App\Models\Palo', 'palo_id');
    }
}
