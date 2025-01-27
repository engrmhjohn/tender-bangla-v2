<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenderSubCategory extends Model
{
    public function category()
    {
        return $this->belongsTo(TenderCategory::class, 'category_id');
    }

    public function tenders()
    {
        return $this->hasMany(Tender::class, 'sub_category_id');
    }
}


