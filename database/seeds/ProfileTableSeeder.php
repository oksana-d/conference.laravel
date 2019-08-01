<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profile')->insert([
            'idProfile' => '1',
            'idUser' => '1',
            'company' => 'albedo',
            'position' => 'Web-developer',
            'photo' => 'no-image.png'
        ]);
        DB::table('profile')->insert([
            'idProfile' => '2',
            'idUser' => '2',
            'company' => 'bwt',
            'position' => 'Web-developer',
            'photo' => 'no-image.png'
        ]);
    }
}
