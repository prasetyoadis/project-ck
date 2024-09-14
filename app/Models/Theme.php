<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;

    protected $fillable = [
        'theme',
        'is_active',
    ];

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
    public function tag() {
        return $this->belongsToMany(Tag::class);
    }
}
