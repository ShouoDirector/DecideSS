<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class HfaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ageGroups = [
            ['age' => 5, 'sex' => 'Female', 'data' => [97.0, 101.9, 106.8, 111.7, 116.6, 121.5, 126.4]],
            ['age' => 6, 'sex' => 'Female', 'data' => [101.7, 107.0, 112.2, 117.5, 122.8, 128.0, 133.3]],
            ['age' => 7, 'sex' => 'Female', 'data' => [106.4, 112.0, 117.6, 123.2, 128.8, 134.4, 140.0]],
            ['age' => 8, 'sex' => 'Female', 'data' => [111.2, 117.1, 123.1, 129.0, 134.9, 140.9, 146.8]],
            ['age' => 9, 'sex' => 'Female', 'data' => [116.3, 122.6, 128.8, 135.0, 141.3, 147.5, 153.7]],
            ['age' => 10, 'sex' => 'Female', 'data' => [121.7, 128.2, 134.8, 141.3, 147.8, 154.3, 160.8]],
            ['age' => 11, 'sex' => 'Female', 'data' => [127.4, 134.2, 140.9, 147.7, 154.4, 161.1, 167.9]],
            ['age' => 12, 'sex' => 'Female', 'data' => [132.9, 139.8, 146.7, 153.6, 160.5, 167.4, 174.3]],
            ['age' => 13, 'sex' => 'Female', 'data' => [137.2, 144.1, 151.1, 158.0, 165.0, 171.9, 178.9]],
            ['age' => 14, 'sex' => 'Female', 'data' => [140.0, 146.9, 153.8, 160.7, 167.7, 174.6, 181.5]],
            ['age' => 15, 'sex' => 'Female', 'data' => [141.6, 148.4, 155.3, 162.1, 169.0, 175.8, 182.6]],
            ['age' => 16, 'sex' => 'Female', 'data' => [142.4, 149.2, 155.9, 162.7, 169.4, 176.2, 182.9]],
            ['age' => 17, 'sex' => 'Female', 'data' => [143.0, 149.6, 156.3, 162.9, 169.6, 176.3, 182.9]],
            ['age' => 18, 'sex' => 'Female', 'data' => [143.4, 150.0, 156.5, 163.1, 169.7, 176.3, 182.9]],
            ['age' => 19, 'sex' => 'Female', 'data' => [143.5, 150.1, 156.6, 163.2, 169.7, 176.2, 182.8]],

            ['age' => 5, 'sex' => 'Male', 'data' => [98.2, 103.0, 107.7, 112.4, 117.1, 121.8, 126.5]],
            ['age' => 6, 'sex' => 'Male', 'data' => [103.2, 108.2, 113.3, 118.4, 123.5, 128.5, 133.6]],
            ['age' => 7, 'sex' => 'Male', 'data' => [107.8, 113.2, 118.6, 124.1, 129.5, 134.9, 140.4]],
            ['age' => 8, 'sex' => 'Male', 'data' => [112.1, 117.9, 123.7, 129.5, 135.3, 141.1, 146.9]],
            ['age' => 9, 'sex' => 'Male', 'data' => [116.3, 122.4, 128.6, 134.7, 140.9, 147.1, 153.2]],
            ['age' => 10, 'sex' => 'Male', 'data' => [120.4, 126.9, 133.4, 140.0, 146.5, 153.0, 159.5]],
            ['age' => 11, 'sex' => 'Male', 'data' => [124.9, 131.7, 138.6, 145.5, 152.4, 159.3, 166.1]],
            ['age' => 12, 'sex' => 'Male', 'data' => [130.2, 137.4, 144.6, 151.9, 159.1, 166.3, 173.6]],
            ['age' => 13, 'sex' => 'Male', 'data' => [136.4, 144.0, 151.5, 159.1, 166.6, 174.2, 181.8]],
            ['age' => 14, 'sex' => 'Male', 'data' => [142.5, 150.3, 158.1, 165.8, 173.6, 181.3, 189.1]],
            ['age' => 15, 'sex' => 'Male', 'data' => [147.4, 155.2, 163.0, 170.8, 178.6, 186.4, 194.2]],
            ['age' => 16, 'sex' => 'Male', 'data' => [150.9, 158.6, 166.3, 174.0, 181.8, 189.5, 197.2]],
            ['age' => 17, 'sex' => 'Male', 'data' => [153.0, 160.5, 168.1, 175.7, 183.3, 190.8, 198.4]],
            ['age' => 18, 'sex' => 'Male', 'data' => [154.2, 161.6, 169.0, 176.4, 183.8, 191.1, 198.5]],
            ['age' => 19, 'sex' => 'Male', 'data' => [154.6, 161.9, 169.2, 176.5, 183.8, 191.1, 198.4]],
        ];

        foreach ($ageGroups as $group) {
            $age = $group['age'];
            $sex = $group['sex'];
            $data = $group['data'];

            foreach ($ageGroups as $group) {
                $age = $group['age'];
                $sex = $group['sex'];
                $data = $group['data'];
    
                DB::table('hfa_standards')->insert([
                    'age' => $age,
                    'sex' => $sex,
                    'negative_thirdSD' => $data[0],
                    'negative_secondSD' => $data[1],
                    'negative_firstSD' => $data[2],
                    'median' => $data[3],
                    'firstSD' => $data[4],
                    'secondSD' => $data[5],
                    'thirdSD' => $data[6],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
