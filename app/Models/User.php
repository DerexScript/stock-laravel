<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use App\Notifications\VerifyEmailNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'username',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*
    public function role()
    {
        return $this->belongsTo(Role::class, "role_id"); //relacão inversa - pertence a
    }
    */

    /*public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }*/

    //sobrepoe o metodo que dispara e-mail de redefinição de senhas
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    //sobrepoe o metodo que dispara e-mail de confirmação de registro
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification($this->name));
    }
}
