<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use function Laravel\Prompts\table;

class UsersTableData extends Seeder
{
    private function isUniqueIdTaken($unique_id): bool
    {
        // Check if the unique_id already exists in the users table
        return DB::table('users')->where('unique_id', $unique_id)->exists();
    }
    
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //============================================================================================
        //--------------------Admin
        //============================================================================================

        DB::table('users')->insert([
            'name' => 'Admin',
            'unique_id' => 'A1-1110001', //RoleType-Division-SCHOOL-ID
            'email' => 'admin@gmail.com',
            'phone_number' => NULL,
            'email_verified_at' => NULL,
            'password' => Hash::make('administrator'),
            'remember_token' => NULL,
            'user_type' => '1',
            'is_deleted' => '0',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        //============================================================================================
        //--------------------Medical Officer
        //============================================================================================

        $districts = [
            //First District
            'Tiwi', 'Malilipot', 'Malinao', 'Sto. Domingo', 'Bacacay East', 'Bacacay West',
            'Bacacay South', 
            
            //Second District
            'Daraga North', 'Daraga South', 'Manito', 'Camalig North', 'Camalig South',
            'Rapu-Rapu East', 'Rapu-Rapu West', 
            
            //Third District
            'Jovellar', 'Guinobatan West', 'Guinobatan East', 'Oas North',
            'Oas South', 'Polangui North', 'Polangui South', 'Libon West', 'Libon East',
            'Pioduran West', 'Pioduran East'
        ];


        foreach ($districts as $key => $district) {
            // Generate mo_code based on the correct pattern
            $mo_code_value = str_pad($key + 1110002, 6, '0', STR_PAD_LEFT);
            
            // Generate unique_id using the district_code and mo_code_value
            $unique_id = 'M2-' . $mo_code_value;
            
            // Generate medical officer email
            $medicalOfficerEmail = strtolower(str_replace(' ', '.', $district)) . '-medicalofficer@gmail.com';
        
            DB::table('users')->insert([
                'name' => $district . ' Medical Officer',
                'unique_id' => $unique_id,
                'email' => $medicalOfficerEmail,
                'phone_number' => NULL,
                'email_verified_at' => NULL,
                'password' => Hash::make($medicalOfficerEmail), // You can set a default password here if needed
                'remember_token' => NULL,
                'user_type' => '2',
                'is_deleted' => '0',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        //============================================================================================
        //--------------------School Nurse
        //============================================================================================

        $schools = [
            'Alcala ES', 'Bagtang ES', 'Balinad ES',
            'Bañadero ES', 'Bañag ES', 'Binitayan ES',
            'Bongalon ES', 'Budiao ES', 'Busay ES', 
            'Cullat ES', 'Daraga North CS', 'Impact LC', 
            'Kidaco ES', 'Kilicao ES',  'Kiwalo ES', 
            'Malobago ES', 'Maroroy ES', 'Matnog ES', 
            'Mi-isi ES', 'Peñafrancia ES', 'Tagas ES'
        ];
        
        foreach ($schools as $key => $school) {
            $sn_code_value = str_pad($key + 1110027, 6, '0', STR_PAD_LEFT);
            $unique_id = 'S3-' . $sn_code_value;

            // Ensure unique_id is unique
            while ($this->isUniqueIdTaken($unique_id)) {
                $sn_code_value++;
                $unique_id = 'S3-' . str_pad($sn_code_value, 6, '0', STR_PAD_LEFT);
            }

            $schoolWords = explode(' ', $school);
            $shortenedName = $schoolWords[0] . ' ' . $schoolWords[1];
            $schoolNurseEmail = strtolower(str_replace(' ', '.', $shortenedName)) . '-schoolnurse@gmail.com';

            DB::table('users')->insert([
                'name' => $shortenedName . ' School Nurse',
                'unique_id' => $unique_id,
                'email' => $schoolNurseEmail,
                'phone_number' => NULL,
                'email_verified_at' => NULL,
                'password' => Hash::make($schoolNurseEmail),
                'remember_token' => NULL,
                'user_type' => '3',
                'is_deleted' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        //============================================================================================
        //--------------------Class Adviser
        //============================================================================================

        DB::table('users')->insert([
            'name' => 'Class Adviser',
            'unique_id' => 'C4-9999999',
            'email' => 'classadviser@gmail.com',
            'phone_number' => NULL,
            'email_verified_at' => NULL,
            'password' => Hash::make('classadviser'),
            'remember_token' => NULL,
            'user_type' => '4',
            'is_deleted' => '0',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        for ($k = 1; $k <= 15; $k++) {
            $email = 'daraganorthcscak' . $k . '@gmail.com';
        
            DB::table('users')->insert([
                'name' => 'DaragaNorthCS CA K' . $k,
                'unique_id' => 'C4-111000' . ($k - 1),
                'email' => $email,
                'phone_number' => NULL,
                'email_verified_at' => NULL,
                'password' => Hash::make($email),
                'remember_token' => NULL,
                'user_type' => '4',
                'is_deleted' => '0',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        $previousUniqueIdEnding = 16;

        for ($group = 1; $group <= 6; $group++) {
            for ($g = 1; $g <= 15; $g++) {
                $email = 'daraganorthcscag' . $group . $g . '@gmail.com';

                DB::table('users')->insert([
                    'name' => 'DaragaNorthCS CA G' . $group . $g,
                    'unique_id' => 'C4-111001' . ($previousUniqueIdEnding + ($group - 1) * 15 + $g),
                    'email' => $email,
                    'phone_number' => NULL,
                    'email_verified_at' => NULL,
                    'password' => Hash::make($email),
                    'remember_token' => NULL,
                    'user_type' => '4',
                    'is_deleted' => '0',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }

            $previousUniqueIdEnding += 15;
        }

        for ($k = 1; $k <= 15; $k++) {
            $email = 'binitayanescak' . $k . '@gmail.com';
        
            DB::table('users')->insert([
                'name' => 'BinitayanES CA K' . $k,
                'unique_id' => 'C4-111097' . ($k - 1),
                'email' => $email,
                'phone_number' => NULL,
                'email_verified_at' => NULL,
                'password' => Hash::make($email),
                'remember_token' => NULL,
                'user_type' => '4',
                'is_deleted' => '0',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        $previousUniqueIdEnding = 112;

        for ($group = 1; $group <= 6; $group++) {
            for ($g = 1; $g <= 15; $g++) {
                $email = 'binitayanescag' . $group . $g . '@gmail.com';

                DB::table('users')->insert([
                    'name' => 'DaragaNorthCS CA G' . $group . $g,
                    'unique_id' => 'C4-111127' . ($previousUniqueIdEnding + ($group - 1) * 15 + $g),
                    'email' => $email,
                    'phone_number' => NULL,
                    'email_verified_at' => NULL,
                    'password' => Hash::make($email),
                    'remember_token' => NULL,
                    'user_type' => '4',
                    'is_deleted' => '0',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }

            $previousUniqueIdEnding += 15;
        }

        for ($k = 1; $k <= 15; $k++) {
            $email = 'kilicaoescak' . $k . '@gmail.com';
        
            DB::table('users')->insert([
                'name' => 'KilicaoES CA K' . $k,
                'unique_id' => 'C4-111142' . ($k - 1),
                'email' => $email,
                'phone_number' => NULL,
                'email_verified_at' => NULL,
                'password' => Hash::make($email),
                'remember_token' => NULL,
                'user_type' => '4',
                'is_deleted' => '0',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        DB::table('users')->insert([
            'name' => 'Medical Officer',
            'unique_id' => 'M2-9999999',
            'email' => 'medicalofficer@gmail.com',
            'phone_number' => NULL,
            'email_verified_at' => NULL,
            'password' => Hash::make('medicalofficer'),
            'remember_token' => NULL,
            'user_type' => '2',
            'is_deleted' => '0',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name' => 'School Nurse',
            'unique_id' => 'S3-9999999',
            'email' => 'schoolnurse@gmail.com',
            'phone_number' => NULL,
            'email_verified_at' => NULL,
            'password' => Hash::make('schoolnurse'),
            'remember_token' => NULL,
            'user_type' => '3',
            'is_deleted' => '0',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }

}