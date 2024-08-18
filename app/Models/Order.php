<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment_id',
        'template_undangan_id',
        'nama_client',
        'tanggal_order',
        'status_order',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function payment() {
        return $this->hasMany(Payment::class);
    }

    public function undangan() {
        return $this->hasOne(Undangan::class);
    }

    public function testimoni() {
        return $this->belongsTo(Testimoni::class);
    }

    public function templateUndangan() {
        return $this->hasOne(TemplateUndangan::class);
    }
}
