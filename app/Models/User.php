<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable {
    use HasFactory;

    protected $fillable = ['name','email','password','role','phone','address'];
    protected $hidden   = ['password','remember_token'];

    public function carts()   { return $this->hasMany(Cart::class); }
    public function orders()  { return $this->hasMany(Order::class); }
    public function messages(){ return $this->hasMany(Message::class); }
    public function isAdmin() { return $this->role === 'admin'; }
}