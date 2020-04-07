<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
//<-ここから     ここまでpath-><-file名         ->
use Illuminate\Http\Request;

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

    use AuthenticatesUsers; //これを書くことによってtraitのメソッドがここで定義されているのと同じになる　class内で使用できる

    protected $maxAttempts = 2;  //AuthenticatesUsersトレイトをuseしていてそのなかこれらのThrottlesLoginsトレイトがuseされているので、LoginControllerにてメンバ変数$maxAttemptを設定することで、ログイン試行回数を設定することができる
    /*
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/todo';  //loginした後の遷移先を指定


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function loggedOut(Request $request)
    {
        return redirect('/login');
    }


    // protected function register (Request $request)
    // {
    //     return redirect('/todo');
    // }
}
