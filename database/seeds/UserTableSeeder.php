<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->insert([
            'idUser'        => '1',
            'firstname'     => 'Oksana',
            'lastname'      => 'Egorova',
            'birthday'      => date('1999-01-25'),
            'reportSubject' => 'Report',
            'country'       => 'UA',
            'phone'         => '+380662326591',
            'email'         => 'oe@albedo.dev',
        ]);
        DB::table('user')->insert([
            'idUser'        => '2',
            'firstname'     => 'Alex',
            'lastname'      => 'Pklped',
            'birthday'      => date('1988-12-25'),
            'reportSubject' => 'Report',
            'country'       => 'UA',
            'phone'         => '+380635026591',
            'email'         => 'exalexedsdc@gmail.com',
        ]);
    }
}
