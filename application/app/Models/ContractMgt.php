<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContractMgt extends Model
{
    protected $guarded = '';
    protected $dateFormat = 'Y-m-d';
    /**
     * Get the clients that owns the ContractMgt
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function clients(): BelongsTo
    {
        return $this->belongsTo(Client::class,'client_id');
    }

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
