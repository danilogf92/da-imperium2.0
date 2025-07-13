<?php

use App\Enums\ClassificationOfInvestments;
use App\Enums\Investment;
use App\Enums\Justification;
use App\Enums\State;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Schema::create('projects', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name');
        //     $table->text('description')->nullable();
        //     $table->foreignId('company_id')->constrained()->cascadeOnDelete();
        //     $table->timestamps();
        // });

        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('pda_code');
            $table->boolean('data_uploaded')->default(false);;
            $table->float('rate');

            $table->foreignId('company_id')->constrained()->cascadeOnDelete(); // ✅ ESTA ES LA CLAVE FALTANTE

            // $table->string('state')->default(State::PLANIFICATION);
            $table->foreignId('state_id')->constrained('states')->cascadeOnDelete();
            // $table->string('investments')->default(Investment::INNOVATION);
            $table->foreignId('investment_id')->constrained('investments')->cascadeOnDelete();
            // $table->string('classification_of_investments')->default(ClassificationOfInvestments::BUILDINGS);
            $table->foreignId('classification_of_investment_id')->constrained('classification_of_investments')->cascadeOnDelete();
            // $table->string('justification')->default(Justification::NORMAL_CAPEX);
            $table->foreignId('justification_id')->constrained('justifications')->cascadeOnDelete();
            $table->date('start_date');
            $table->date('finish_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
