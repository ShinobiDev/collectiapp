<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'type_parent_id'];

    // Un tipo puede tener un tipo padre (ej. "Tipo de Documento" -> "Cédula de Ciudadanía")
    public function parentType()
    {
        return $this->belongsTo(Type::class, 'type_parent_id');
    }

    // Un tipo padre puede tener muchos tipos hijos
    public function childTypes()
    {
        return $this->hasMany(Type::class, 'type_parent_id');
    }

    // Relación con User (si 'type_document_id' en User se refiere a un Type)
    public function users()
    {
        return $this->hasMany(User::class, 'type_document_id');
    }
}
