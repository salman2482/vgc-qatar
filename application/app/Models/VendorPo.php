<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorPo extends Model
{
    protected $proteded = [];
    
    public function attachments() {
        return $this->morphMany('App\Models\Attachment', 'attachmentresource');
    }
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}
