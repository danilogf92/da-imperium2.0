<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Justification extends Model
{
    /** @use HasFactory<\Database\Factories\JustificationFactory> */
    use HasFactory;

    protected $fillable = ['justification_name'];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
