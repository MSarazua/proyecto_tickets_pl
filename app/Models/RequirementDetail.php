<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequirementDetail extends Model
{
    use HasFactory;

    protected $fillable = ['requirement_id', 'files'];

    public function requirement()
    {
        return $this->belongsTo(Requirement::class);
    }
}
