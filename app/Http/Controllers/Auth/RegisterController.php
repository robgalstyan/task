<?php

namespace App\Http\Controllers\Auth;

use App\Mail\SendVerificationEmail;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email_token' => $data['token'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $token = Str::random(40);
        $request_data = $request->all();
        $request_data['token'] = $token;
        event(new Registered($user = $this->create($request_data)));                //???????????????????????????

//        $this->guard()->login($user);
        $this->send_verification_email($user, $token);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath())->with('success', 'Check your email for verification');
    }

    function send_verification_email($user, $token){

        Mail::to($user)->send(new SendVerificationEmail($token, $user));
    }

    public function verifyEmail(Request $request){
        $email = $request->email;
        $token = $request->token;

        $user = User::where(['email' => $email, 'email_token' => $token])->first();

        if($user){
            $this->guard()->login($user);
            $user->verified = 1;
            $user->save();

            return redirect('home')->with('success', 'Your email was successfully verified');
        }
        else{
            return redirect('login')->with('error', 'Verification failed');
        }
    }
}
