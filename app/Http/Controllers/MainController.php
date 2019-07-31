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

    public function checkExistsEmail()
    {
        if(isset($_POST['email'])) {
            if (Main::checkExistsEmail($_POST['email'])) {
                echo(json_encode(false));
            } else {
                echo(json_encode(true));
            }
        }
    }
}
