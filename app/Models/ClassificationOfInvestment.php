<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassificationOfInvestment extends Model
{
    /** @use HasFactory<\Database\Factories\ClassificationOfInvestmentFactory> */
    use HasFactory;

    protected $fillable = ['classification_name'];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
