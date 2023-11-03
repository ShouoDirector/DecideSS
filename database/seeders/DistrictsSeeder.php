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

        $medicalOfficerID = 2;

        foreach ($districts_first as $district) {
            DB::table('districts_table')->insert([
                'district' => $district,
                'medical_officer_id' => $medicalOfficerID,
                'is_deleted' => '0',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            // Increment medical officer ID for the next iteration
            $medicalOfficerID++;
        }

        //=====================================================
        //-----------------SECOND DISTRICT---------------------
        //=====================================================
        $districts_second = [
            'Daraga North', 'Daraga South', 'Manito', 'Camalig North', 'Camalig South', 'Rapu-Rapu East', 'Rapu-Rapu West'
        ];

        $medicalOfficerID = 9;

        foreach ($districts_second as $district) {
            DB::table('districts_table')->insert([
                'district' => $district,
                'medical_officer_id' => $medicalOfficerID,
                'is_deleted' => '0',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            // Increment medical officer ID for the next iteration
            $medicalOfficerID++;
        }

        //=====================================================
        //-----------------THIRD DISTRICT----------------------
        //=====================================================
        $districts_third = [
            'Jovellar', 'Guinobatan West', 'Guinobatan East', 'Oas North',
            'Oas South', 'Polangui North', 'Polangui South', 'Libon West',
            'Libon East', 'Pioduran West', 'Pioduran East'
        ];

        $medicalOfficerID = 16;

        foreach ($districts_third as $district) {
            DB::table('districts_table')->insert([
                'district' => $district,
                'medical_officer_id' => $medicalOfficerID,
                'is_deleted' => '0',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            // Increment medical officer ID for the next iteration
            $medicalOfficerID++;
        }

    }
};
