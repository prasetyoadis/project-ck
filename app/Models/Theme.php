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
