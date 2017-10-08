<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function var_dump;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('home', [
            'balance' => Auth::user()->getBalance(),
            'users'   =>  User::all()->whereNotIn('id', Auth::user()->id)
        ] );
    }

    public function verify_user(User $user, Request $request){

    }

    public function finish_transfer(Request $request){
        $user = $request->input('user');
        $sum = $request->input('sum');
	    User::find($user)->addBalance($sum);
        Auth::user()->removeBalance($sum);
        return back()->withInput();
    }
}
