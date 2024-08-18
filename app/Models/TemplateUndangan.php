<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateUndangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_template',
        'category',
        'is_active',
    ];

    public function order() {
        return $this->belongsTo(Order::class);
    }
}
