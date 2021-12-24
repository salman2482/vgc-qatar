<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rfm extends Model
{
    protected $guarded = [];
    protected $date = ['due_date','created_at','updated_at'];

      /**
     * relatioship business rules:
     *         - the Client can have many Payments
     *         - the Payment belongs to one Client
     */
    public function users() {
        return $this->hasMany('App\Models\User', 'inline_manager_id', 'hoc_id');
    }

    /**
     * Get all of the rfmMaterials for the Rfm
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rfmMaterials(): HasMany
    {
        return $this->hasMany(RfmMaterial::class);
    }
}
