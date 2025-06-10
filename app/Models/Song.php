<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getRouteKeyName(){
        return 'uuid';
    }

    // Search
    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $s){
            return $query->where(function($query) use ($s) {
                $query->where('nama_lagu', 'like', '%' . $s . '%');
            });
        });
    }

    public function undangan()
    {
        return $this->hasOne(Undangan::class);
    }
}
