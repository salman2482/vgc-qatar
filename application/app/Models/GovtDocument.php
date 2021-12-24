<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GovtDocument extends Model
{
    protected $guarded = [];

    public function attachments() {
        return $this->morphMany('App\Models\Attachment', 'attachmentresource');
    }
}
