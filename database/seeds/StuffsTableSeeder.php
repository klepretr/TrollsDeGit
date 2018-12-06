<?php

use Illuminate\Database\Seeder;

class StuffsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0; $i<10;$i++) {
    		\DB::table('stuffs')->insert([
            'name' => str_random(10),
            'description' => str_random(10),
            'type' => str_random(5),
            'user_guide' => str_random(20),
            'state' => 'tofix',
        ]);
    	}
    }
}
