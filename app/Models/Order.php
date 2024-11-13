<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    //Route Model Binding
    public function getRouteKeyName(){
        return 'uuid';
    }

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
        return $this->hasOne(Theme::class);
    }
}
