<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public function districts()
    {
        return $this->hasMany(District::class);
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
}