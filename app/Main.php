<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Main extends Model
{
    public static function checkExistsEmail($email)
    {
        $countUser = DB::table('user')->where('email', $email)->count();
        return $countUser > 0 ? true : false;
    }

    public static function saveUserInfo($data)
    {
        $id = DB::table('user')->insertGetId([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'birthday' => date('Y-m-d', strtotime($data['birthday'])),
            'reportSubject' => $data['reportSubject'],
            'country' => $data['country'],
            'phone' => $data['phone'],
            'email' => $data['email'],
        ]);

        return $id;
    }
}
