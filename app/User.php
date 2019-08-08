<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class User extends Model
{
    /**
     * Save user information from the first form.
     *
     * @param  array  $data Role first form data
     *
     * @return int
     */
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

    /**
     * Update user information from the second form.
     *
     * @param  array  $data Role second form data
     * @param  int  $id Role id member
     * @param string $photo Role photo member
     *
     *  @return void
     */
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

    /**
     * Get count conference participants.
     *
     * @return int
     */
    public static function getCountAllMembers()
    {
        $countUser = DB::table('user')->where('show', '=', '1')->count();

        return $countUser;
    }

    /**
     * Get conference participants not hidden by administrator.
     *
     * @param  int  $id  Role id member
     *
     * @return int
     */
    public static function getShowUser($id)
    {
        $show = DB::table('user')->select('show')->where('idUser', $id)->get();

        return $show;
    }

    /**
     * Change the visibility of the conference participants in the list All members.
     *
     * @param  int  $id Role id member
     * @param  int  $show Role of visibility value of the member in the list All members
     *
     * @return void
     */
    public static function changeUserInfo($id, $show)
    {
        DB::table('user')
          ->where('idUser', $id)
          ->update(['show' => $show]);
    }

    /**
     * Get the information of the conference participants.
     *
     * @return LengthAwarePaginator
     */
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
