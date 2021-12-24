<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Material extends Model
{
    protected $guarded = [];
    /**
     * Get all of the rfmMaterials for the Rfm
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rfmMaterials(): HasMany
    {
        return $this->hasMany(RfmMaterial::class);
    }

    public function rfqMaterials(): HasMany
    {
        return $this->hasMany(RfqMaterial::class);
    }
}
