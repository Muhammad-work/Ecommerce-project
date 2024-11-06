<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Ensure you extend the correct class
use Illuminate\Notifications\Notifiable;

class user extends  Authenticatable 
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'img',
        'phone',
        'address',
        'password',
        'role'
    ];

    public function orders() {
        return $this->hasMany(Order::class); // Assuming a user can have many orders
    }
}
