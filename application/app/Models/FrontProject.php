<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrontProject extends Model
{
    protected $guarded = []; 
    protected $table = 'front_project'; 

    public function attachments() {
        return $this->morphMany('App\Models\Attachment', 'attachmentresource');
    }
}
