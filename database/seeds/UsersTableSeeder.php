<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'name'     => 'admin',
            'email'    => 'oe@albedo.dev',
            'password' => '$2y$10$TKD6GGPJXXk6v33P48ecJun9UtweMQ0DYtKerju60g8H0HLqLgQXy'//7taa3e99ci9m
        ]);
    }
}
