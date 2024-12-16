<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Undangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'cpria_id',
        'cwanita_id',
        'story',
        'song',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function cpria()
    {
        return $this->hasOne(Cpria::class);
    }

    public function cwanita()
    {
        return $this->hasOne(Cwanita::class);
    }

    public function gallery()
    {
        return $this->hasMany(Gallery::class);
    }

    public function events()
    {
        return $this->hasMany(Events::class);
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    public function donation()
    {
        return $this->hasMany(Donation::class);
    }

    public function stories()
    {
        return $this->hasMany(Stories::class);
    }
}
