<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {

        $user = Auth::user();

        /*if (Auth::check()) {
            echo "You've logged in";
        } else {
            echo "error";
        }*/

        return view('admin.home', compact('user'));

    }
}
