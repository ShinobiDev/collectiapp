<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Volume extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'collection_id'];

    // Un volumen pertenece a una colección
    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }

    // Relación de muchos a muchos con User
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_volume', 'volume_id', 'user_id')->withTimestamps();
    }
}
