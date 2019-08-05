<?php

namespace App\Http\Controllers;

use App\Members;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
        $members = Members::getMembersInfo();
        foreach ($members as $member) {
            if ($member->photo == null) {
                $member->photo = 'no-image.png';
            }
        }
        return view('members', compact('members'));
    }

    public function changeUserInfo($id){
        if (User::getShowUser($id)){
            User::changeUserInfo($id, false);
        } else {
            User::changeUserInfo($id, true);
        }
    }
}
