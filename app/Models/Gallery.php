<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'undangan_id',
        'slug',
    ];

    public function undangan() {
        return $this->belongsTo(Undangan::class);
    }
}
