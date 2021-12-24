<?php

namespace App\Models;

use App\Models\FProduct;
use Illuminate\Database\Eloquent\Model;

class SubProduct extends Model
{
    protected $guarded = '';
    protected $table = 'sub_products';

    public function attachments() {
        return $this->morphMany('App\Models\Attachment', 'attachmentresource');
    }

    
    public function fproduct()
    {
        return $this->belongsTo(FProduct::class, 'f_product_id');
    }

}
