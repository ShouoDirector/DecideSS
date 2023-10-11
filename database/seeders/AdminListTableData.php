<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use function Laravel\Prompts\table;

class AdminListTableData extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admin_list')->insert([
            'email' => 'admin@gmail.com',
            'division' => 'none',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('admin_list')->insert([
            'email' => 'medicalofficer@gmail.com',
            'division' => 'Daraga North',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('admin_list')->insert([
            'email' => 'schoolnurse@gmail.com',
            'division' => 'Daraga South',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('admin_list')->insert([
            'email' => 'classadviser@gmail.com',
            'division' => 'Malilipot',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
