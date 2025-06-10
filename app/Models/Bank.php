<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getRouteKeyName(){
        return 'code';
    }

    // Search
    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $s){
            return $query->where(function($query) use ($s) {
                $query->where('nama_bank', 'like', '%' . $s . '%');
            });
        });
    }

    public function donations() {
        return $this->hasMany(Donation::class);
    }
}
