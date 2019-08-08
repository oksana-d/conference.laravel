<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class User extends Model
{
    public static function saveUserInfo($data)
    {
        $id = DB::table('user')->insertGetId([
            'firstname'     => $data['firstname'],
            'lastname'      => $data['lastname'],
            'birthday'      => date('Y-m-d', strtotime($data['birthday'])),
            'reportSubject' => $data['reportSubject'],
            'country'       => $data['country'],
            'phone'         => $data['phone'],
            'email'         => $data['email'],
        ]);

        return $id;
    }

    public static function updateUserInfo($data, $id, $photo)
    {
        DB::table('profile')->insert([
            'idUser'   => $id,
            'company'  => $data['company'],
            'position' => $data['position'],
            'aboutMe'  => $data['aboutMe'],
            'photo'    => $photo,
        ]);
    }

    public static function getCountAllMembers()
    {
        $countUser = DB::table('user')->count();

        return $countUser;
    }

    public static function getShowUser($id)
    {
        $show = DB::table('user')->select('show')->where('idUser', $id)->get();

        return $show;
    }

    public static function changeUserInfo($id, $show)
    {
        DB::table('user')
          ->where('idUser', $id)
          ->update(['show' => $show]);
    }

    public static function getUserInfo()
    {
        if (! Auth::check()) {
            $membersInfo = DB::table('user')->
            leftJoin('profile', 'user.idUser', '=', 'profile.idUser')->
            select('user.idUser', 'photo', 'firstname', 'lastname', 'reportSubject', 'email', 'show')->
            where('show', '=', '1')->
            paginate(10, array('user.idUser', 'photo', 'firstname', 'lastname', 'reportSubject', 'email', 'show'));

            return $membersInfo;
        } else {
            $membersInfo = DB::table('user')->
            leftJoin('profile', 'user.idUser', '=', 'profile.idUser')->
            select('user.idUser', 'photo', 'firstname', 'lastname', 'reportSubject', 'email', 'show')->
            paginate(10, array('user.idUser', 'photo', 'firstname', 'lastname', 'reportSubject', 'email', 'show'));

            return $membersInfo;
        }
    }
}
