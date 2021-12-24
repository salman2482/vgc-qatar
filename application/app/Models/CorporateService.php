<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CorporateService extends Model
{
    protected $guarded = [];
    protected $table = 'corporate_services';

    public function attachments() {
        return $this->morphMany('App\Models\Attachment', 'attachmentresource');
    }

    /**
     * Get all of the subcorporateservices for the CorporateService
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subcorporateservices(): HasMany
    {
        return $this->hasMany(SubCorporateService::class,'corporateservice_id');
    }
}

