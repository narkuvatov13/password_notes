<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Password extends Model
{
    protected $fillable = [
        'user_id',
        'url',
        'name',
        'username',
        'password',
        'message',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
