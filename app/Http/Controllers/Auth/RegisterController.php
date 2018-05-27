<?php

namespace ctf\Http\Controllers\Auth;

use ctf\Http\Controllers\Controller;
use ctf\Http\Requests\UserRequest;
use ctf\Models\Maestria;
use ctf\Models\Permission;
use ctf\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = "/";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $permission;

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $maestrias = Maestria::all();
        return view('auth.register', compact('maestrias'));
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(UserRequest $request)
    {
        event(new Registered($user = $this->create($request->all())));
        $this->guard()->login($user);
        return redirect()->home();
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \ctf\User
     */
    protected function create(array $data)
    {
        $user = ['id' => md5(rand()), 'nickname' => $data['nickname'], 'email' => $data['email'],
            'password' => bcrypt($data['password']), 'avatar' => $data['avatar'],];
        if ($countUsers = User::all()->count() === 0) {
            try {
                $this->permission->fill(['permissao' => getenv('ADMIN_PERM')])->save();
            } catch (\Exception $e) {
            }
            $user['permissao_id'] = $this->permission->where(
                'permissao', getenv('ADMIN_PERM'))->first()->id;
        }
        return (new \ctf\User)->create($user);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(UserRequest $data)
    {
        return $data;
    }
}
