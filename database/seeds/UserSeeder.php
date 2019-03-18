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
            'id' => '2',
            'name' => 'admin',
            'email' => 'memesoe@gmail.com',
            'password' => bcrypt('12345'),
            'type' => '2',
            'phone' => '0912345689',
            'dob' => '1996-10-01',
            'profile' => 'mesoe',
            'create_user_id'=>'2',
            'updated_user_id'=>'2'
        ]);
    }
}
