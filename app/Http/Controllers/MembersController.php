<?php

namespace App\Http\Controllers;

use App\Members;
use Illuminate\Http\Request;

class MembersController extends Controller
{
    public function index()
    {
        $members = Members::getMembersInfo();
        //var_dump($members).die();
        return view('members', compact('members'));
    }
}
