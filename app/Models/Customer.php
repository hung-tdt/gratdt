<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Customer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    

    protected $fillable = [
        'name',
        'username',
        'password',
        'email',
        'phone',
        'thumb',
        'address',
        'province_id',
        'district_id',
        'ward_id',
        'active',
        'description'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function savedCoupons()
    {
        return $this->hasMany(SavedCoupon::class);
    }

    public function province() {
        return $this->hasOne(Province::class, 'id', 'province_id');
    }

    public function district() {
        return $this->hasOne(District::class, 'id', 'district_id');
    }

    public function ward() {
        return $this->hasOne(Ward::class, 'id', 'ward_id');
    }

    public function cart()
    {
        return $this->hasOne(Cart::class); 
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
