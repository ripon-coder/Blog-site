<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;;
use Illuminate\Foundation\Auth\AuthenticatesUsers;



class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = '/admin';


    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm(){
        return view('admin.login',[
            'title' => 'Admin Login',
            'loginRoute' => 'admin.login',
            'forgotPasswordRoute' => 'admin.password.request',
        ]);

    }

    public function login(Request $request){  
    $this->validator($request);
    if(Auth::guard('admin')->attempt($request->only('email','password'),$request->filled('remember'))){
        //Authentication passed...
        return redirect()
            ->intended(route('admin.dashboard'))
            ->with('status','You are Logged in as Admin!');
    }

    //Authentication failed...
    return $this->loginFailed();
  }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()
            ->route('show.login')
            ->with('status','Admin has been logged out!');
    }

  private function validator(Request $request){
    //validation rules.
    $rules = [
        'email'    => 'required|email|exists:admins|min:5|max:191',
        'password' => 'required|string|min:6|max:255',
    ];

    //custom validation error messages.
    $messages = [
        'email.exists' => 'Email does not found our record',
    ];

    //validate the request.
    $request->validate($rules,$messages);
    }
    private function loginFailed(){
        return redirect()
            ->back()
            ->withInput()
            ->with('error','Login failed, please try again!');
    }

    protected function guard(){
        return Auth::guard('admin');
    }

public function test(){
    return Hash::make('123456');
}
    
}
