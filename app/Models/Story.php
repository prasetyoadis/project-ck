<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function undangan()
    {
        return $this->belongsTo(Undangan::class);
    }
}
