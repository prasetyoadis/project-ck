<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];
    
    public function order() {
        return $this->hasOne(Order::class);
    }
}
