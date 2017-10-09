<?php

namespace App\Http\Controllers;

use App\Jobs\CreateTransaction;
use App\Repositories\Users\UsersRepositoryInterface;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    protected $usersRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UsersRepositoryInterface $usersRepository)
    {
        $this->middleware('auth');
        $this->usersRepository = $usersRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request )
    {
        return view('home', [
            'balance' => $this->usersRepository->getBalance($request->user()),
            'users'   =>  User::all()->whereNotIn('id', Auth::id())
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function transfer(Request $request){
        $userTo = $request->input('user');
        $sum = $request->input('sum');
        CreateTransaction::dispatch(Auth::user(), User::find($userTo), $sum);
        return view('welcome');
    }
}
