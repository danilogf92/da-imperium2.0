<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\ClassificationOfInvestment;
use App\Models\Company;
use App\Models\Investment;
use App\Models\Justification;
use App\Models\Project;
use App\Models\State;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // $companies = Company::factory()->count(3)->create();

        State::factory()->count(3)->create();
        Investment::factory()->count(8)->create();
        Justification::factory()->count(2)->create();
        ClassificationOfInvestment::factory()->count(10)->create();

        $company1 = Company::create(['name' => 'CIESA']);
        $company2 = Company::create(['name' => 'GRALCO']);
        $company3 = Company::create(['name' => 'SEAFMAN']);

        // Crear usuario fijo para login
        User::create([
            'name' => 'Danilo',
            'email' => 'danilo.granda@corpo-medica.com',
            'password' => Hash::make('Danilogf91'),
            'role' => Role::ADMIN,
            'company_id' => $company1->id, // Asociado a la primera empresa
        ]);

        User::create([
            'name' => 'User 1',
            'email' => 'user1@email.com',
            'password' => Hash::make('password'),
            'role' => Role::USER,
            'company_id' => $company2->id, // Asociado a la primera empresa
        ]);

        User::create([
            'name' => 'User 2',
            'email' => 'user2@email.com',
            'password' => Hash::make('password'),
            'role' => Role::USER,
            'company_id' => $company3->id, // Asociado a la primera empresa
        ]);

        foreach ([$company1, $company2, $company3] as $company) {
            Project::factory()->count(2)->create([
                'company_id' => $company->id,
            ]);
        }
    }
}
