<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrontBanner extends Model
{
    protected $guarded = [];
    protected $table = 'front_banners';
    
    public function attachments() {
        return $this->morphMany('App\Models\Attachment', 'attachmentresource');
    }
}
