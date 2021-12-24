<?php

namespace App\Models;

use App\Models\SubProduct;
use Illuminate\Database\Eloquent\Model;

class FProduct extends Model
{
    protected $guarded = [];
    protected  $table = 'f_products';

    public function attachments() {
        return $this->morphMany('App\Models\Attachment', 'attachmentresource');
    }

    public function category()
    {
        return $this->belongsTo(FCategory::class, 'f_category_id', 'id');
    }

    public function subproducts()
    {
        return $this->hasMany(SubProduct::class);
    }
}
