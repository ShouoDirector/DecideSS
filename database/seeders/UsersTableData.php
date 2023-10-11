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
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => NULL,
            'password' => Hash::make('administrator'),
            'remember_token' => NULL,
            'user_type' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Medical Officer',
            'email' => 'medicalofficer@gmail.com',
            'email_verified_at' => NULL,
            'password' => Hash::make('medicalofficer'),
            'remember_token' => NULL,
            'user_type' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name' => 'School Nurse',
            'email' => 'schoolnurse@gmail.com',
            'email_verified_at' => NULL,
            'password' => Hash::make('schoolnurse'),
            'remember_token' => NULL,
            'user_type' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Class Adviser',
            'email' => 'classadviser@gmail.com',
            'email_verified_at' => NULL,
            'password' => Hash::make('classadviser'),
            'remember_token' => NULL,
            'user_type' => 4,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}