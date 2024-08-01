<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Undangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'cpria_id',
        'cwanita_id',
        'story',
        'song',
    ];

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function cpria() {
        return $this->belongsTo(Cpria::class);
    }

    public function cwanita() {
        return $this->belongsTo(Cwanita::class);
    }

    public function gallery() {
        return $this->hasMany(Gallery::class);
    }

    public function events() {
        return $this->hasMany(Events::class);
    }
}
