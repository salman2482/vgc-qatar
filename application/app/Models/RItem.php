<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RItem extends Model
{
    protected $guarded = [];

    /**
     * Get all of the rfqitems for the RItems
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rfqitems(): HasMany
    {
        return $this->hasMany(RfqItems::class);
    }
}
