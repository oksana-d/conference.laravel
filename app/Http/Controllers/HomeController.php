<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveUserPost;
use App\Main;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function saveUserInfo(SaveUserPost $request)
    {
        if($request->isMethod('post')) {
            $idUser = Main::saveUserInfo($request->all());
            Session::put('idUser', $idUser);
            return response()->view('profile');
        }
    }

    public function updateUserInfo(Request $request)
    {
        if ($request->isMethod('post')) {
            $imageName = 'no-image.png';
            $config = Config::get('share');
            $countMembers = Main::getCountAllMembers();
            if (!empty($request->file('photo'))) {
                $destinationPath = 'users';
                $imageName = uniqid() . '.' . $request->file('photo')->getClientOriginalExtension();
                $request->file('photo')->move($destinationPath, $imageName);
            }

            Main::updateUserInfo($request->all(), Session::get('idUser'), $imageName);
            Session()->forget('idUser');

            return view('share', [ 'link' => $config['share']['link'],
                                        'text' => $config['share']['text'],
                                        'countMembers' => $countMembers]);
        }
    }

}
