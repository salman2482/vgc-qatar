<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RfmMaterial extends Model
{
    protected $guarded = [];
    /**
     * Get the rfms that owns the RfmMaterial
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rfm(): BelongsTo
    {
        return $this->belongsTo(Rfm::class);
    }

    /**
     * Get the material that owns the RfmMaterial
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }
}
