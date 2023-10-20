<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DistrictsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

    //=====================================================
    //-----------------FIRST DISTRICT----------------------
    //=====================================================
        $districts_first = [
            'Tiwi', 'Malilipot', 'Malinao', 'Sto. Domingo',
            'Bacacay East', 'Bacacay West', 'Bacacay South'
        ];

        foreach ($districts_first as $district) {
            $medicalOfficerEmail = strtolower(str_replace(' ', '.', $district)) . '-medicalofficer@gmail.com';
            DB::table('districts_table')->insert([
                'district' => $district,
                'medical_officer_email' => $medicalOfficerEmail,
                'is_deleted' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        //=====================================================
        //-----------------SECOND DISTRICT---------------------
        //=====================================================
        $districts_second = [
            'Daraga North', 'Daraga South', 'Manito', 'Camalig North', 'Camalig South', 'Rapu-Rapu East', 'Rapu-Rapu West'
        ];

        foreach ($districts_second as $district) {
            $medicalOfficerEmail = strtolower(str_replace(' ', '.', $district)) . '-medicalofficer@gmail.com';
            DB::table('districts_table')->insert([
                'district' => $district,
                'medical_officer_email' => $medicalOfficerEmail,
                'is_deleted' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        //=====================================================
        //-----------------THIRD DISTRICT----------------------
        //=====================================================
        $districts_third = [
            'Jovellar', 'Guinobatan West', 'Guinobatan East', 'Oas North',
            'Oas South', 'Polangui North', 'Polangui South', 'Libon West',
            'Libon East', 'Pioduran West', 'Pioduran East'
        ];

        foreach ($districts_third as $district) {
            $medicalOfficerEmail = strtolower(str_replace(' ', '.', $district)) . '-medicalofficer@gmail.com';
            DB::table('districts_table')->insert([
                'district' => $district,
                'medical_officer_email' => $medicalOfficerEmail,
                'is_deleted' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

    }
}
