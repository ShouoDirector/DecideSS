<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SchoolsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schools = [
            'Alcala Elementary School', 'Bagtang Elementary School', 'Balinad Elementary School',
            'Bañadero Elementary School', 'Bañag Elementary School', 'Binitayan Elementary School',
            'Bongalon Elementary School', 'Budiao Elementary School'
        ];
        
        $barangays = [
            'Alcala', 'Bagtang', 'Sagpon', 'Bañadero', 'Bañag', 'Binitayan', 'Bongalon', 'Anislag'
        ];
        
        $district = 8;

        $schoolNurseID = 27;
        
        foreach ($schools as $key => $school) {
            $schoolId = 111657 + $key; // First School's ID start from 111657 and increment by 1
            $barangay = $barangays[$key]; // Get the corresponding barangay
        
            DB::table('schools_table')->insert([
                'school_id' => $schoolId,
                'school' => $school,
                'school_nurse_id' => $schoolNurseID,
                'address_barangay' => $barangay, // Use the corresponding barangay
                'district_id' => $district,
                'is_deleted' => '0',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            $schoolNurseID++;
        }

    }
}
