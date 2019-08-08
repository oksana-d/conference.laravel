<?php

namespace App\Http\Controllers;

use App\User;

class MembersController extends Controller
{
    public function index()
    {
        $members = User::getUserInfo();
        foreach ($members as $member) {
            if ($member->photo == null) {
                $member->photo = 'no-image.png';
            }
        }

        return view('members', compact('members'));
    }
}
