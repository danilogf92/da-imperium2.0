<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    /** @use HasFactory<\Database\Factories\InvestmentFactory> */
    use HasFactory;

    protected $fillable = ['investment_name'];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
