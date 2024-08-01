<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;

    protected $fillable = [
        'undangan_id',
        'nama_acara',
        'tanggal',
        'alamat',
        'link_gmaps',
    ];

    public function undangan() {
        return $this->belongsTo(Undangan::class);
    }
}
