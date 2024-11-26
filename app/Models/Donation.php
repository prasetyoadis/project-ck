<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function bank() {
        return $this->hasMany(Bank::class);
    }

    public function undangan() {
        return $this->belongsTo(Undangan::class);
    }
}
