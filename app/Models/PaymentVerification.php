<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentVerification extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'member_id');
    }


    protected $guarded = [];
    use HasFactory;
}
