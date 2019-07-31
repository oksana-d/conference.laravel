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
}
