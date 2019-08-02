<?php

namespace App\Http\Controllers;

use App\Members;
use Illuminate\Http\Request;

class MembersController extends Controller
{
    public function index()
    {
        $members = Members::getMembersInfo();
        foreach ($members as $member){
            if($member->photo == null){
                $member->photo = 'no-image.png';
            }
        }
        return view('members', compact('members'));
    }
}
