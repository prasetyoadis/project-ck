<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Testimoni extends Model
{
    use HasFactory;

    protected $fillable = [
        'testimoni',
        'rating',
    ];

    public function order() {
        return $this->hasOne(Order::class);
    }
}
