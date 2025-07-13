<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'company_id',
        'pda_code',
        'data_uploaded',
        'rate',
        'state_id',
        'investment_id',
        'classification_of_investment_id',
        'justification_id',
        'start_date',
        'finish_date',
    ];

    /**
     * Casts para usar enums automáticamente.
     */
    protected $casts = [
        'start_date' => 'date',
        'finish_date' => 'date',
        'data_uploaded' => 'boolean',
        'rate' => 'float',
    ];


    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function investment()
    {
        return $this->belongsTo(Investment::class);
    }

    public function justification()
    {
        return $this->belongsTo(Justification::class);
    }

    public function classificationOfInvestment(): BelongsTo
    {
        return $this->belongsTo(ClassificationOfInvestment::class, 'classification_of_investment_id');
    }
}
