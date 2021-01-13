<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'price', 'slug', 'category_id', 'shop_id', 'desc', 'stock', 'thumbnail'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function shop()
    {
        return $this->belongsTo(User::class, 'shop_id');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function comments(){
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }
}
