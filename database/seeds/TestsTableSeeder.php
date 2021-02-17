<?php

use App\Test;
use Illuminate\Database\Seeder;

class TestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Test::create([
            'code' => 'ABC123',
            'type' => 'fixed',
            'value' => 30,
        ]);

        Test::create([
            'code' => 'DEF456',
            'type' => 'percent',
            'percent_off' => 50,
        ]);
    }
}
