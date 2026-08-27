<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    // protected function casts(): array
    // {
    //     return [
    //         'email_verified_at' => 'datetime',
    //         'password' => 'hashed',
    //     ];
    // }
 /**
     * Retorna o identificador único que será guardado no token (ID do usuário).
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Permite adicionar informações customizadas dentro do token (ex: ['role' => $this->role]).
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    protected $fillable = [
        'name','email','password','avatar',
        'cpf','phone1','phone2','role'
    ];

        public function driver(){
        return $this->belongsToMany(Vehicle::class);
    }
        public function trip(){
        return $this->belongsToMany(Trip::class);
    }
}
