<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for($i=0; $i<10;$i++) {
    		\DB::table('users')->insert([
            'name' => str_random(10),
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret'),
            'role'=>0,
            'age'=>12,
            'gender'=>1,
            'firstname'=>'John'.i, 
            'lastname'=>'Doe'.i,
            'phone'=>'+33666666',
        ]);
    	}
        
    }
}
