<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model {
    protected $fillable = [
        'category_id','title','author','publisher',
        'year','price','stock','cover','description','isbn'
    ];

    public function category()   { return $this->belongsTo(Category::class); }
    public function carts()      { return $this->hasMany(Cart::class); }
    public function orderItems() { return $this->hasMany(OrderItem::class); }

    public function getFormattedPriceAttribute() {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }
}