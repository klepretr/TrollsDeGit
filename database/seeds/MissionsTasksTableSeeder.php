<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MissionsTasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for(i=0; i<10;i++) {
    		\DB::table('stuffs_tasks')->insert([
            'description' => str_random(10),
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now(),
            'mission_id' => 1,
        ]);
    	}
    }
}
