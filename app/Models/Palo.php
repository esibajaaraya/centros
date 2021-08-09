<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Palo extends Model
{
    protected $table = 'palos';

    public function barajacarta() {
        return $this->belongsTo('App\Models\BarajaCarta', 'palo_id');
    }
}
