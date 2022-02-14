<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\sewer;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
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
    //protected $redirectTo = '/Admin_Amoora';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->redirectTo = '/login';
        $this->middleware('guest')->except('logout');

    }

    public function login(Request $request)
    {   
        $input = $request->all();
  
        $this->validate($request, [
            'name' => 'required',
            'password' => 'required',
        ]);
        $fieldType = filter_var($request->name, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        if(auth()->attempt(array($fieldType => $input['name'], 'password' => $input['password'])))
        {
            $data_user = User::where('name',$request->name)->first();
            $id_sewer = sewer::where('id_users',$data_user->id)->value('id_sewer');
            if($data_user->role == '0'){
                return redirect()->route('sewer',['id_sewer'=>$id_sewer]);
            }else{
                return redirect()->route('index_admin');
            }
          
        }else{
            return redirect()->route('login')
                ->with('error','Email-Address And Password Are Wrong.');
        }
          
    }
}

