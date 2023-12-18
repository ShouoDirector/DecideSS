<?php

namespace Database\Seeders;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UsersTableData::class);
        $this->call(DistrictsSeeder::class);
        $this->call(SchoolsSeeder::class);
        $this->call(HfaSeeder::class);
        $this->call(SchoolYearPhaseSeeder::class);
        $this->call(SectionsTableSeeder::class);
    }
}
