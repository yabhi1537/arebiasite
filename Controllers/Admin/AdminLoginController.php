<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Admin;
use Session;



class AdminLoginController extends Controller
{ 
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }
    public function index()
    {
        // $data = AdminLogin::all();
       // return view('auth.login', ['url' => 'admin']);
        return view('admin.auth.login');
    }
    public function home()
    {
		return view('admin.auth.login');
	}
    public function login(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);
        
        
        if (Auth::guard('admin')->attempt($request->only(['email','password']), $request->get('remember'))){
			
            return redirect()->intended('admin/dashboard');
        }
        return back()->withInput($request->only('email'));

    }
    public function logout(Request $request )
	{
		
		Auth::guard('admin')->logout();
		
		return redirect(route('admin.login'));
	}


}