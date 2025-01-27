<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tender extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    // old code

    // public function category()
    // {
    //     return $this->belongsTo(TenderCategory::class, 'category_id');
    // }

    // public function subCategory()
    // {
    //     return $this->hasOne(TenderSubCategory::class, 'id', 'sub_category_id');
    // }

    // old code

    public function subCategory()
    {
        return $this->belongsTo(TenderSubCategory::class, 'sub_category_id');
    }
}
