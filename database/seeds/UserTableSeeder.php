<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {
 
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vader = DB::table('users')->insert([
                'username'   => 'doctorv',
                'email'      => 'darthv@deathstar.com',
                'password'   => Hash::make('thedarkside'),
                'first_name' => 'Darth',
                'last_name'  => 'Vader',
				'fullname'  => 'Darth Vader',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ]);
 
        DB::table('users')->insert([
                'username'   => 'goodsidesoldier',
                'email'      => 'lightwalker@rebels.com',
                'password'   => Hash::make('hesnotmydad'),
                'first_name' => 'Luke',
                'last_name'  => 'Skywalker',
				'fullname'  => 'Luke Skywalker',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ]);
 
        DB::table('users')->insert([
                'username'   => 'greendemon',
                'email'      => 'dancingsmallman@rebels.com',
                'password'   => Hash::make('yodaIam'),
                'first_name' => 'Yoda',
                'last_name'  => 'Unknown',
				'fullname'  => 'Yoda Unknown',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ]);
    }
 
}