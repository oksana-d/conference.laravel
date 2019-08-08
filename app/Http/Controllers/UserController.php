<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveUserPost;
use App\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\UpdateUserPost;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Show the first form.
     */
    public function index()
    {
        return view('user');
    }

    /**
     * Save user information from the first form.
     *
     * @param  SaveUserPost  $request Role of valid data of the first form
     *
     * @return Response
     */
    public function saveUserInfo(SaveUserPost $request)
    {
        if ($request->isMethod('post')) {
            $idUser = User::saveUserInfo($request->all());
            Session::put('idUser', $idUser);

            return response()->view('profile');
        }
    }

    /**
     * Save user information from the first form.
     *
     * @param  UpdateUserPost  $request  Role of valid data of the second form
     *
     * @return Response
     */
    public function updateUserInfo(UpdateUserPost $request)
    {
        if ($request->isMethod('post')) {
            $imageName = 'no-image.png';
            $config = Config::get('share');
            $countMembers = User::getCountAllMembers();
            if (! empty($request->file('photo'))) {
                $destinationPath = 'users';
                $imageName = uniqid().'.'.$request->file('photo')->getClientOriginalExtension();
                $request->file('photo')->move($destinationPath, $imageName);
            }

            User::updateUserInfo($request->all(), Session::get('idUser'), $imageName);
            Session()->forget('idUser');

            return response()->view('share', [
                'link'         => $config['share']['link'],
                'text'         => $config['share']['text'],
                'countMembers' => $countMembers,
            ]);
        }
    }
}
