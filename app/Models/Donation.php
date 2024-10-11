<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pemilik',
        'no_rek'
    ];

    protected $guarded = ['nama_pemilik', 'no_rek'];

    public function bank() {
        return $this->hasMany(Bank::class);
    }
}
