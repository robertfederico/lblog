<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'role_id' => 1,
            'name' => 'Robert Federico',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
        ]);

        DB::table('users')->insert([
            'role_id' => 2,
            'name' => 'John Delacruz',
            'username' => 'john',
            'email' => 'john@gmail.com',
            'password' => bcrypt('admin123'),
        ]);
    }
}