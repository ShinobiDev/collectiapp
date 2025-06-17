<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Collection extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'category_id', // Corregido 'categroy_id' a 'category_id'
        'gender_id',   // Corregido 'Gender_id' a 'gender_id'
        'author_id',
        'editorial_id',
        'date',
    ];

    protected $casts = [
        'date' => 'date', // Si 'Date' es una columna de fecha
    ];

    // Relación con Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relación con Gender
    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    // Relación con Author
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    // Relación con Editorial
    public function editorial()
    {
        return $this->belongsTo(Editorial::class);
    }

    // Una colección tiene muchos volúmenes
    public function volumes()
    {
        return $this->hasMany(Volume::class);
    }

    // Relación de muchos a muchos con User
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_collection', 'collection_id', 'user_id')->withTimestamps();
    }
}
