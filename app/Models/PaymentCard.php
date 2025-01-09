<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentCard extends Model
{


    // Payment Table All Columns Fullable
    protected $guarded = [];


    // User Table Relation
    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }
}
