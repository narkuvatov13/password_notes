<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Enums\Gender;

class Address extends Model
{

    protected $casts = [
        // "gender" => Gender::class,
        "birthday" => "date",
    ];
    protected $fillable = [
        'user_id',
        'title',
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

    // Address get Birthday database
    public function getBirthdayAttribute($value)
    {
        return  \Carbon\Carbon::parse($value)->format('d/m/Y');
    }
    // Address set Birthday Database
    // public function setBirthdayAttribute($value)
    // {
    //     $this->attributes['birthday'] = \Carbon\Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    // }
}
