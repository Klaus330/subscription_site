<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AdminLoginController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles authenticating users for the application and
	| redirecting them to your home screen. The controller uses a trait
	| to conveniently provide its functionality to your applications.
	|
	*/

	use AuthenticatesUsers;

	/**
	 * Where to redirect users after login.
	 *
	 * @var string
	 */
	protected $redirectTo = '/';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest')->except('logout');
	}

	public function showLoginForm()
	{
		if(auth()->guard('admin','web')->check())
			return redirect('/');

		return view('admin.auth.login');
	}
	
	public function login(Request $request)
	{
		$this->validate(request(),[
			'email' => 'required|email',
			'password' => 'required'
		]);

		if(!auth()->guard('admin')->attempt(request(['email','password']))){
			return back()->withErrors([
				'message' => 'Please check your credentials and try again.'
			]);
		}
		return redirect()->intended(route("admin.dashboard"));
	}

	public function adminLogout()
	{
		auth()->guard('admin')->logout();
		return redirect('/');
	}
}
