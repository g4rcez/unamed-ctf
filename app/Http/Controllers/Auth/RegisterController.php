<?php

namespace ctf\Http\Controllers\Auth;

use ctf\Http\Controllers\Controller;
use ctf\Http\Requests\UserRequest;
use ctf\Models\Permission;
use ctf\Models\Skill;
use ctf\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
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
        $skills = Skill::all();
        return view('auth.register', compact('skills'));
    }

    /**
     * Handle a registration request for the application.
     *
     * @param UserRequest $request
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
        $user = [
            'nickname' => $data['nickname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'avatar' => $data['avatar']
        ];
        if ($countUsers = User::all()->count() === 0) {
            try {
                $this->permission->fill(['name' => getenv('ADMIN_PERM')])->save();
            } catch (\Exception $e) {
            }
            $user['permission_id'] = $this->permission
                ->where('name', getenv('ADMIN_PERM'))->first()->id;
        }
        return (new User)->create($user);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param UserRequest $data
     * @return array|UserRequest
     */
    protected function validator(UserRequest $data)
    {
        return $data;
    }
}
