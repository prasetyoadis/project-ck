<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cwanita extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = [
        'nama',
        'nm_ayah',
        'nm_ibu',
    ];

    public function undangan() {
        return $this->belongsTo(Undangan::class);
    }
}
