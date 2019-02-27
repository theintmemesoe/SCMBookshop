<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => '1',
            'name' => 'memesoe',
            'email' => 'memesoe@gmail.com',
            'password' => bcrypt('memesoe'),
            'type' => '1',
            'phone' => '0912345689',
            'dob' => '1996-10-01',
            'profile' => 'mesoe',
            'create_user_id'=>'1',
            'updated_user_id'=>'1'
        ]);
    }
}
