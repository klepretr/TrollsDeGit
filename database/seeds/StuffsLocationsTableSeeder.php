<?php

use Illuminate\Database\Seeder;

class StuffsLocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0; $i<20;$i++) {
    		\DB::table('stuffs_locations')->insert([
            'batiment_number' => $i%3+1,
            'stuff_id' =>$i
            
        ]);
    	}
    }
}
