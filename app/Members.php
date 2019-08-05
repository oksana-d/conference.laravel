<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Members extends Model
{
    public static function getMembersInfo()
    {
        if (!Auth::check()) {
            $membersInfo = DB::table('user')->
            leftJoin('profile', 'user.idUser', '=', 'profile.idUser')->
            select('user.idUser', 'photo', 'firstname', 'lastname', 'reportSubject', 'email', 'show')->
            where('show', '=', '1')->
            get();
            return $membersInfo->toArray();
        } else {
            $membersInfo = DB::table('user')->
            leftJoin('profile', 'user.idUser', '=', 'profile.idUser')->
            select('user.idUser', 'photo', 'firstname', 'lastname', 'reportSubject', 'email', 'show')->
            get();
            return $membersInfo;
        }
    }
}
