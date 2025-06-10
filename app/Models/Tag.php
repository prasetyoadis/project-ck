<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    public function getRouteKeyName(){
        return 'slug';
    }
    
    // Search
    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $s){
            return $query->where(function($query) use ($s) {
                $query->where('nama_tag', 'like', '%' . $s . '%');
            });
        });
    }

    public function theme() {
        return $this->belongsToMany(Theme::class);
    }
}
