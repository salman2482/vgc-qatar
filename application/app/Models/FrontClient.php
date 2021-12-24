<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrontClient extends Model
{
    protected $guarded = []; 
    protected $table = 'front_client';
    
    public function attachments() {
        return $this->morphMany('App\Models\Attachment', 'attachmentresource');
    }
}
