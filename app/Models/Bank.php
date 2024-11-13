<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_bank',
        'is_active',
    ];

    public function donation() {
        return $this->belongsTo(Donation::class);
    }
}
