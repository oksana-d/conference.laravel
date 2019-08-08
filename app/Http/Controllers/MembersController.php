<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;

class MembersController extends Controller
{
    /**
     * Get the information of the conference participants.
     */
    public function index()
    {
        if (! Auth::check()) {
            $members = User::getUserInfo();
            foreach ($members as $member) {
                if ($member->photo == null) {
                    $member->photo = 'no-image.png';
                }
            }

            return view('members', compact('members'));
        } else {
            return redirect()->action('AdminController@index');
        }
    }
}
