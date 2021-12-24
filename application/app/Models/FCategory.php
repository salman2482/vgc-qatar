<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FCategory extends Model
{
    public function products()
    {
        return $this->hasMany(FProduct::class);
    }
}
