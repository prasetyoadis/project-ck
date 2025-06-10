<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Route Model Binding
    public function getRouteKeyName(){
        return 'uuid';
    }

    // Search
    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $s){
            return $query->where(function($query) use ($s) {
                $query->where('nama', 'like', '%' . $s . '%')
                      ->orWhereRelation('order', 'uuid', 'like', '%' . $s . '%');
            });
        });
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

    public function review() {
        return $this->belongsTo(Review::class);
    }

}
