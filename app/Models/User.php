<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'img',
        'locale'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    // Relations Function

    // Password
    public function passwords()
    {
        return $this->hasMany(Password::class);
    }

    // Note
    public function notes()
    {
        return $this->hasMany(Note::class);
    }


    // Address
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }


    // Payment Card Relation
    public function paymentCards()
    {
        return $this->hasMany(PaymentCard::class);
    }



    public function bankAccounts()
    {
        return $this->hasMany(BankAccount::class);
    }
}
