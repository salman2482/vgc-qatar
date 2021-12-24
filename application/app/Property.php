<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $guarded=[];

     /**
     * relatioship business rules:
     *         - the Expense can have many Attachments
     *         - the Attachment belongs to one Expense
     *         - other Attachments can belong to other tables
     */
    public function attachments() {
        return $this->morphMany('App\Models\Attachment', 'attachmentresource');
    }
}
