<?php

namespace App;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class FrontVendorRegistration extends Model
{
    protected $table = 'front_vendor_registrations';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
