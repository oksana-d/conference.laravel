<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Members extends Model
{
    public static function getMembersInfo()
    {
        $membersInfo = DB::table('user')->
                        leftJoin('profile', 'user.idUser', '=', 'profile.idUser')->
                        select('user.idUser', 'photo', 'firstname', 'lastname', 'reportSubject', 'email')->
                        get();
        return $membersInfo;
    }
}
