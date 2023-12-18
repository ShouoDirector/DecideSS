<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SchoolYearPhaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $startYear = 2023;
        $endYear = 2030;

        for ($currentYear = $startYear; $currentYear <= $endYear; $currentYear++) {
            $this->createSchoolYear($currentYear, 'Baseline');
            $this->createSchoolYear($currentYear, 'Endline');
        }
    }

    /**
     * Create a school year record.
     *
     * @param int    $year
     * @param string $phase
     *
     * @return void
     */
    private function createSchoolYear($year, $phase)
    {
        DB::table('school_year')->insert([
            'school_year' => $year . ' - ' . ($year + 1),
            'phase'       => $phase,
            'status'      => 'Unset',
            'is_deleted'  => '0',
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ]);
    }
}
