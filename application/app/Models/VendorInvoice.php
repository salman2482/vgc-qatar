<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorInvoice extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
