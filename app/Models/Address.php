<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{

    protected $casts = [];
    protected $fillable = [
        'user_id',
        'first_name',
        'middle_name',
        'last_name',
        'username',
        'gender',
        'birthday',
        'company',
        'address',
        'city',
        'country',
        'state',
        'postal_code',
        'email',
        'phone_number',
        'mobile_phone_number',
        'fax',
        'notes',
    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
