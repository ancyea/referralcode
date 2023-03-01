<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Points;

class PointsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Points::insert([
            [
                'level' => 1,
                'points' => 10
            ],
            [
                'level' => 2,
                'points' => 9
            ],
            [
                'level' => 3,
                'points' => 8
            ],
            [
                'level' => 4,
                'points' => 7
            ],
            [
                'level' => 5,
                'points' => 6
            ],
            [
                'level' => 6,
                'points' => 5
            ],
            [
                'level' => 7,
                'points' => 4
            ],
            [
                'level' => 8,
                'points' => 3
            ],
            [
                'level' => 9,
                'points' => 2
            ],
            [
                'level' => 10,
                'points' => 1
            ],
        ]);
    }
}
