<?php

namespace App\Models;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Get;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

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

    public static function getForm(): array
    {
        return [
            Section::make('Project Details')
                ->label(false)
                // ->description('Provide some basic information about directions')
                // ->icon('heroicon-o-rectangle-stack')
                // ->columns(2)
                ->columns(['md' => 2, 'lg' => 3])
                ->schema([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('pda_code')
                        ->prefix('PDA-')
                        ->minLength(3)
                        ->maxLength(255)
                        ->required()
                        ->maxLength(255)
                        ->formatStateUsing(fn($state) => str_starts_with($state, 'PDA-') ? substr($state, 4) : $state)
                        ->dehydrateStateUsing(fn($state) => str_starts_with($state, 'PDA-') ? $state : 'PDA-' . $state),
                    Toggle::make('data_uploaded')
                        ->hidden()
                        ->disabled()
                        ->required(),
                    TextInput::make('rate')
                        ->minValue(0)
                        ->maxValue(5)
                        ->required()
                        ->numeric(),
                    Select::make('company_id')
                        ->label('Company')
                        ->required()
                        ->options(function () {
                            $user = Auth::user();

                            return $user->role === 'admin'
                                ? Company::pluck('name', 'id')
                                : Company::where('id', $user->company_id)->pluck('name', 'id');
                        })
                        ->default(fn() => Auth::user()->company_id)
                        ->disabled(fn() => Auth::user()->role !== 'admin'),
                    Select::make('state_id')
                        ->relationship('state', 'state_name')
                        ->required(),
                    Select::make('investment_id')
                        ->relationship('investment', 'investment_name')
                        ->required(),
                    Select::make('classification_of_investment_id')
                        ->relationship('classificationOfInvestment', 'classification_name')
                        ->required(),
                    Select::make('justification_id')
                        ->relationship('justification', 'justification_name')
                        ->required(),

                    DatePicker::make('start_date')
                        ->required()
                        ->reactive()
                        ->rules([
                            function (Get $get) {
                                return function (string $attribute, $value, \Closure $fail) use ($get) {
                                    $finish = $get('finish_date');
                                    if ($finish && Carbon::parse($value)->gte(Carbon::parse($finish))) {
                                        $fail(__('The start date must be earlier than the finish date.'));
                                    }
                                };
                            },
                        ]),

                    DatePicker::make('finish_date')
                        ->required()
                        ->reactive()
                        ->rules([
                            function (Get $get) {
                                return function (string $attribute, $value, \Closure $fail) use ($get) {
                                    $start = $get('start_date');
                                    if ($start && Carbon::parse($value)->lte(Carbon::parse($start))) {
                                        $fail(__('The finish date must be later than the start date.'));
                                    }
                                };
                            },
                        ]),
                ])
        ];
    }
}
