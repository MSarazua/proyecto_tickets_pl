<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    use HasFactory;

    protected $fillable = [
        'requirement_title',
        'priority',
        'description',
        'references',
        'user_id',
        'dev_user_id',
        'status',
    ];

     // Relación con el modelo User (cliente)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relación con el modelo Área
    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    // Relación con el modelo User (dev)
    public function devUser()
    {
        return $this->belongsTo(User::class, 'dev_user_id');
    }

    public function details()
    {
        return $this->hasMany(RequirementDetail::class);
    }

    public function logs() {
        return $this->hasMany(TicketLog::class);
    }
}
