<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RfqMaterial extends Model
{
    protected $guarded = [];
    protected $table = 'rfq_materials';
    /**
     * Get the rfms that owns the RfqMaterial
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vendorrfq(): BelongsTo
    {
        return $this->belongsTo(VendorRfq::class);
    }


    /**
     * Get the material that owns the RfqMaterial
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }
}
