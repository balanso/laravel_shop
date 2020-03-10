<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['name', 'code', 'description', 'category_id', 'price', 'image', 'hit', 'new', 'recommend'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function getPriceForCount() {
        return $this->price*$this->pivot->count;
    }

    public function scopeHit($query) {
        return $query->where('hit', 1);
    }


    public function scopeNew($query) {
        return $query->where('new', 1);
    }


    public function scopeRecommend($query) {
        return $query->where('recommend', 1);
    }

    public function isHit() {
        return $this->hit === 1;
    }

    public function isNew() {
        return $this->new === 1;
    }

    public function isRecommend() {
        return $this->recommend === 1;
    }

    public function setNewAttribute($attribute) {
        $this->attributes['new'] = $attribute === 'on' ? 1 : 0;
    }

    public function setHitAttribute($attribute) {
        $this->attributes['hit'] = $attribute === 'on' ? 1 : 0;
    }

    public function setRecommendAttribute($attribute) {
        $this->attributes['recommend'] = $attribute === 'on' ? 1 : 0;
    }
}
