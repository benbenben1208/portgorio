<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'admin',
            'email' => 'user@example',
            'password' => Hash::make('12345678'),
            'remember_token' => Str::random(10),
        ]);     
    }
}
