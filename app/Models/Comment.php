<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'ucapan'
    ];

    public function undangan() {
        return $this->belongsTo(Undangan::class);
    }
}
