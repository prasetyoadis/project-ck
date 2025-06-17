<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Undangan extends Model
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
                $query->whereRelation('uuid', 'like', '%' . $s . '%')
                      ->orWhere('slug', 'like', '%' . $s . '%');
            });
        });
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function theme() {
        return $this->belongsTo(Theme::class);
    }
    public function couple()
    {
        return $this->belongsTo(Couple::class);
    }
    public function song()
    {
        return $this->belongsTo(Song::class);
    }
    
    public function events()
    {
        return $this->hasMany(Event::class);
    }
    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }
    public function stories()
    {
        return $this->hasMany(Story::class);
    }
    public function donations()
    {
        return $this->hasMany(Donation::class);
    }
    public function rsvps()
    {
        return $this->hasMany(Rsvp::class);
    }
}
