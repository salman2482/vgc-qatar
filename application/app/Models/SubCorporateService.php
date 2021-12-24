<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubCorporateService extends Model
{
    protected $table = 'sub_corporate_services';

    public function attachments() {
        return $this->morphMany('App\Models\Attachment', 'attachmentresource');
    }
    
    /**
     * Get the corporateservice associated with the SubCorporateService
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function corporateservice(): BelongsTo
    {
        return $this->belongsTo(CorporateService::class);
    }
}
