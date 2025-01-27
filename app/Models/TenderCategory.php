<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenderCategory extends Model
{
    public function subCategories()
    {
        return $this->hasMany(TenderSubCategory::class, 'category_id');
    }
}
