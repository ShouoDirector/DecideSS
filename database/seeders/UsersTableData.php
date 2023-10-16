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
            'is_deleted' => 0,
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
            'is_deleted' => 0,
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
            'is_deleted' => 0,
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
            'is_deleted' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Medical Officer1',
            'email' => 'medicalofficer1@gmail.com',
            'email_verified_at' => NULL,
            'password' => Hash::make('medicalofficer1'),
            'remember_token' => NULL,
            'user_type' => 2,
            'is_deleted' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name' => 'School Nurse1',
            'email' => 'schoolnurse1@gmail.com',
            'email_verified_at' => NULL,
            'password' => Hash::make('schoolnurse1'),
            'remember_token' => NULL,
            'user_type' => 3,
            'is_deleted' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Class Adviser1',
            'email' => 'classadviser1@gmail.com',
            'email_verified_at' => NULL,
            'password' => Hash::make('classadviser1'),
            'remember_token' => NULL,
            'user_type' => 4,
            'is_deleted' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name' => 'School Nurse2',
            'email' => 'schoolnurse2@gmail.com',
            'email_verified_at' => NULL,
            'password' => Hash::make('schoolnurse2'),
            'remember_token' => NULL,
            'user_type' => 3,
            'is_deleted' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Class Adviser2',
            'email' => 'classadviser2@gmail.com',
            'email_verified_at' => NULL,
            'password' => Hash::make('classadviser2'),
            'remember_token' => NULL,
            'user_type' => 4,
            'is_deleted' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name' => 'School Nurse3',
            'email' => 'schoolnurse3@gmail.com',
            'email_verified_at' => NULL,
            'password' => Hash::make('schoolnurse3'),
            'remember_token' => NULL,
            'user_type' => 3,
            'is_deleted' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Class Adviser3',
            'email' => 'classadviser3@gmail.com',
            'email_verified_at' => NULL,
            'password' => Hash::make('classadviser3'),
            'remember_token' => NULL,
            'user_type' => 4,
            'is_deleted' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Class Adviser4',
            'email' => 'classadviser4@gmail.com',
            'email_verified_at' => NULL,
            'password' => Hash::make('classadviser4'),
            'remember_token' => NULL,
            'user_type' => 4,
            'is_deleted' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Class Adviser5',
            'email' => 'classadviser5@gmail.com',
            'email_verified_at' => NULL,
            'password' => Hash::make('classadviser5'),
            'remember_token' => NULL,
            'user_type' => 4,
            'is_deleted' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Class Adviser6',
            'email' => 'classadviser6@gmail.com',
            'email_verified_at' => NULL,
            'password' => Hash::make('classadviser6'),
            'remember_token' => NULL,
            'user_type' => 4,
            'is_deleted' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}