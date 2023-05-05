<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
    }
    public function index()
    {
        if (Auth::check()) {
            if (Auth::attempt([
                'email' => Auth::user()->email,
                'password' =>  Auth::user()->password,
                'level' => 1,
            ])) {
                return  view('admin.index');
            }
            return  redirect()->route('checkLogin.index');
        }
        return  view('admin.login');
    }

    public function checkLogin()
    {
        return  view('admin.login');
    }
    public function postCheckLogin(Request $request)
    {
        if (Auth::check()) {
            if (Auth::attempt([
                'email' => $request->email,
                'password' =>  $request->password,
                'level' => 1,
            ])) {
                return  view('admin.index');
            }
            return  redirect()->route('checkLogin.index');
        }
        return  view('admin.login');
    }
}
