<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    // Si quieres que el campo 'name' sea fillable
    protected $fillable = ['name'];

    // Si es necesario definir la relación inversa
    public function requirements()
    {
        return $this->hasMany(Requirement::class);
    }
}
