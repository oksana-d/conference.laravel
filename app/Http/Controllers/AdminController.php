<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
        $members = User::getUserInfo();
        foreach ($members as $member) {
            if ($member->photo == null) {
                $member->photo = 'no-image.png';
            }
        }
        return view('members', compact('members'));
    }

    public function changeUserInfo($id){
        $showUser = User::getShowUser($id);
        if ($showUser[0]->show == 1){
            User::changeUserInfo($id, false);
        } else {
            User::changeUserInfo($id, true);
        }
    }
}
