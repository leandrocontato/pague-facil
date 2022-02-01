<?php

namespace App\Models;

use Illuminate\Auth\Notifications\ResetPassword;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hash;

class Password extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'password_reset';

    protected $fillable = [
        'email',
        'token',
        'created_at',
        'updated_at'
    ];


    /*
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new Password($token));
    }
    */

}
