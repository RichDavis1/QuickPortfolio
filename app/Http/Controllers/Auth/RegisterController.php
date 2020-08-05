<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Register site admin.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function adminRegister(Request $request) : JsonResponse
    {
        if (User::adminExists()) {
            header('HTTP/1.0 403 Forbidden', true, 403);
            exit();
        }

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', Rule::in([env('ADMIN_EMAIL')])],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'auth_code' => ['required', 'string', Rule::in([env('AUTH_CODE')])],
        ]);

        if ($validator->fails()) {
            return response()->json(['result' => 'failed', 'errors' => $validator->errors()]);
        }

        $user = $this->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        $user->role = 'admin';
        $user->save();

        Auth::login($user);
        Auth::attempt(['email' => $request->email, 'password' => $request->password], true);

        return response()->json(['result' => 'success', 'url' => '/']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);
    }
}
