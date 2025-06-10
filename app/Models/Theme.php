<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getRouteKeyName(){
        return 'slug';
    }
    
    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $s){
            return $query->where(function($query) use ($s) {
                $query->where('nama_tema', 'like', '%' . $s . '%');
            });
        });
        $query->when((isset($filters['category']) ? $filters['category'] : false), function($query, $c){
            return $query->whereHas('category', function($query) use ($c){
                $query->where('slug', $c); 
            });
        });
        $query->when((isset($filters['tag']) ? $filters['tag'] : false), function($query, $t){
            return $query->whereHas('tags', function($query) use ($t){
                $query->where('slug', $t); 
            });
        });
    }

    public function undangan() {
        return $this->hasOne(Undangan::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
    public function tags() {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }
}
