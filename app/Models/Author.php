<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'birthday'];

    protected $casts = [
        'birthday' => 'date',
    ];

    public function collections()
    {
        return $this->hasMany(Collection::class);
    }
}
