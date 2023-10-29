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
            'email' => 'admin@gmail.com',
            'phone_number' => NULL,
            'email_verified_at' => NULL,
            'password' => Hash::make('administrator'),
            'remember_token' => NULL,
            'user_type' => 1,
            'is_deleted' => 0,
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

        foreach ($districts as $district) {
            $medicalOfficerEmail = strtolower(str_replace(' ', '.', $district)) . '-medicalofficer@gmail.com';

            DB::table('users')->insert([
                'name' => $district . ' Medical Officer',
                'email' => $medicalOfficerEmail,
                'phone_number' => NULL,
                'email_verified_at' => NULL,
                'password' => Hash::make($medicalOfficerEmail), // You can set a default password here if needed
                'remember_token' => NULL,
                'user_type' => 2,
                'is_deleted' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        //============================================================================================
        //--------------------School Nurse
        //============================================================================================
        $schools = [
            'Alcala Elementary School', 'Bagtang Elementary School', 'Balinad Elementary School',
            'Bañadero Elementary School', 'Bañag Elementary School', 'Binitayan Elementary School',
            'Bongalon Elementary School', 'Budiao Elementary School'
        ];
        
        foreach ($schools as $school) {
            $schoolWords = explode(' ', $school);
            $shortenedName = $schoolWords[0] . ' ' . $schoolWords[1]; // First two words of the school name
            $schoolNurseEmail = strtolower(str_replace(' ', '.', $shortenedName)) . '-schoolnurse@gmail.com';
        
            DB::table('users')->insert([
                'name' => $shortenedName . ' School Nurse',
                'email' => $schoolNurseEmail,
                'phone_number' => NULL,
                'email_verified_at' => NULL,
                'password' => Hash::make($schoolNurseEmail), // You can set a default password here if needed
                'remember_token' => NULL,
                'user_type' => 3, // Assuming 3 represents School Nurse user type
                'is_deleted' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        DB::table('users')->insert([
            'name' => 'Class Adviser',
            'email' => 'classadviser@gmail.com',
            'phone_number' => NULL,
            'email_verified_at' => NULL,
            'password' => Hash::make('classadviser'),
            'remember_token' => NULL,
            'user_type' => 4,
            'is_deleted' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        
    }
}