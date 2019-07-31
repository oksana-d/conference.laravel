<?php

namespace App\Http\Controllers;

use App\Main;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index()
    {
        return view('main');
    }

    public function checkExistsEmail(Request $request)
    {
        if($request->has('email')) {
            if (Main::checkExistsEmail($request->input('email'))) {
                echo(json_encode(false));
            } else {
                echo(json_encode(true));
            }
        }
    }
}
