<?php

namespace App\Http\Controllers;

use App\Main;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    public function index()
    {
        return view('main');
    }

    public function checkExistsEmail(Request $request)
    {
        if($request->isMethod('post') && $request->has('email')) {
            if (Main::checkExistsEmail($request->input('email'))) {
                echo(json_encode(false));
            } else {
                echo(json_encode(true));
            }
        }
    }

    public function saveUserInfo(Request $request)
    {
        if($request->isMethod('post')) {
            $idUser = Main::saveUserInfo($request->all());
            Session::put('idUser', $idUser);
            return view('profile');
        }
    }

    public function updateUserInfo(Request $request)
    {
        if ($request->isMethod('post')) {
            $imageName = null;

            if (!empty($request->file('photo'))) {
                $destinationPath = 'users';
                $imageName = uniqid() . '.' . $request->file('photo')->getClientOriginalExtension();
                $request->file('photo')->move($destinationPath, $imageName);
            }

            Main::updateUserInfo($request->all(), Session::get('idUser'), $imageName);
            Session()->forget('idUser');
        }
    }

}
