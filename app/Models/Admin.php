<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable; // Often useful for admins too
use Illuminate\Auth\Authenticatable; // Trait that provides authentication methods
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract; // The interface

class Admin extends Model implements AuthenticatableContract // Implement the interface
{
    use HasFactory, Notifiable, Authenticatable; // Use the Authenticatable trait

    protected $fillable = [
        "email",
        "password",
    ];

    protected $hidden = [
        'password',
        'remember_token', // Add remember_token to hidden as well
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
