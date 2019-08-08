<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Get the information of the conference participants.
     */
    public function index()
    {
        if (Auth::check()) {
            $members = User::getUserInfo();
            foreach ($members as $member) {
                if ($member->photo == null) {
                    $member->photo = 'no-image.png';
                }
            }

            return view('members', compact('members'));
        } else {
            return redirect()->action('UserController@index');
        }
    }

    /**
     * Change the visibility of the conference participants in the list All members.
     *
     * @param  int  $id  Role id member
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeUserInfo($id)
    {
        $showUser = User::getShowUser($id);
        if ($showUser[0]->show == 1) {
            User::changeUserInfo($id, false);

            return response()->json([
                'message' => 'Show this member in the list of All members',
            ]);

        } else {
            User::changeUserInfo($id, true);

            return response()->json([
                'message' => 'Hide this member in the list of All members',
            ]);
        }
    }
}
