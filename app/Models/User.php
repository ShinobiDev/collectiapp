<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'type_document_id',
        'document',
        'email',
        'password',
        'birthday',
        'role_id',
        'status_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'birthday' => 'date', // Castear la fecha de nacimiento
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey(); // Devuelve ID del usuario
    }

    // Método requerido por JWTSubject
    public function getJWTCustomClaims()
    {
        return []; // Aquí puedes agregar claims adicionales si quieres
    }

    // Relación con Role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Relación con Status
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    // Relación con Type (para el tipo de documento)
    public function documentType()
    {
        return $this->belongsTo(Type::class, 'type_document_id');
    }

    // Relación de muchos a muchos con Collection (para colecciones favoritas, por ejemplo)
    public function collections()
    {
        return $this->belongsToMany(Collection::class, 'user_collection', 'user_id', 'collection_id')->withTimestamps();
    }

    // Relación de muchos a muchos con Volume (para volúmenes que el usuario tiene, lee, etc.)
    public function volumes()
    {
        return $this->belongsToMany(Volume::class, 'user_volume', 'user_id', 'volume_id')->withTimestamps();
    }
}
