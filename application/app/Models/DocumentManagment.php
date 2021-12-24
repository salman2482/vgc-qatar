<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentManagment extends Model
{
    protected $guarded = '';


    public const EXPIRED = 'expired';
    public const ACTIVE = 'active';
    public const APPROVAL = 'waiting for approval';
    public const REJECTED = 'rejected';
    public const REVISED = 'to be revised';
    public const FINAL = 'final';

     /**s
     * relatioship business rules:
     *         - the Expense can have many Attachments
     *         - the Attachment belongs to one Expense
     *         - other Attachments can belong to other tables
     */
    public function attachments() {
        return $this->morphMany('App\Models\Attachment', 'attachmentresource');
    }
}
