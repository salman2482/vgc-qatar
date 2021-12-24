<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VendorRfq extends Model
{
    protected $guraded = [];

    public function attachments() {
        return $this->morphMany('App\Models\Attachment', 'attachmentresource');
    }
    
    /**
     * Get all of the rfqitems for the VendorRfq
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rfqitems(): HasMany
    {
        return $this->hasMany(RfqItems::class);
    }
}
