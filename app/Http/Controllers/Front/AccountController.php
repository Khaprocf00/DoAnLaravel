<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    private $cart;
    private $user;
    public function __construct(Cart $cart, User $user)
    {
        $this->cart = $cart;
        $this->user = $user;
    }
    public function login()
    {
        $cart = $this->cart->all();
        $subTotal = 0;
        $cart = $this->cart->all();
        foreach ($cart as $item) {
            $item->total = ($item->price * $item->qty);
            $subTotal += ($item->price * $item->qty);
        }
        return view('front.Account.login', compact('cart', 'subTotal'));
    }
    public function checkLogin(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'level' => 2,
        ];
        $remember = $request->remember;
        if (Auth::attempt($credentials, $remember)) {
            return redirect('');
        } else {
            return back()->with('notification', 'Error: Email or password is wrong');
        }
    }
    public function logout()
    {
        Auth::logout();
        return back();
    }
    public function register()
    {
        $cart = $this->cart->all();
        $subTotal = 0;
        $cart = $this->cart->all();
        foreach ($cart as $item) {
            $item->total = ($item->price * $item->qty);
            $subTotal += ($item->price * $item->qty);
        }
        return view('front.Account.register', compact('cart', 'subTotal'));
    }
    public function postRegister(Request $request)
    {
        if ($request->password != $request->password_confirmation) {
            return back()->with('notification', 'Error: Confirm password does not match');
        }
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' =>  2,
        ];
        $this->user->create($data);
        return redirect('account/login')->with('notificationsuccess', 'Register Success! Please Login');
    }
}