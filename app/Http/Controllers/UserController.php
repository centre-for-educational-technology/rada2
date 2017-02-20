<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

use App\Role;

use Auth;

class UserController extends Controller
{
    /**
     * Where to redirect users after login.
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
        $this->middleware(['auth', 'auth.admin']);
    }

    /**
     * Display a listing of Users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('manage/users/index')->with([
            'users' => User::with(['social_accounts', 'roles'])->paginate( config('paginate.limit') ),
            'roles' => Role::all(),
        ]);
    }

    /**
     * [removeRole description]
     * @param  User   $user [description]
     * @param  Role   $role [description]
     * @return [type]       [description]
     */
    public function removeRole(User $user, Role $role)
    {
        if ( !$user->hasRole($role->name) || ( $role->name === 'admin' && $user->id === Auth::user()->id ) )
        {
            return response()->json(['error' => 'Forbidden.'], 403);
        }

        $user->roles()->detach($role);
        $user->load('roles');

        return response()->json(['user' => $user->id, 'role' => $role->id, 'roles' => $user->getRolesData()], 200);
    }

    /**
     * [assignRoles description]
     * @param  Request $request [description]
     * @param  User    $user    [description]
     * @return [type]           [description]
     */
    public function assignRoles(Request $request, User $user)
    {
        $roles = $request->get('roles');
        $syncableRoles = [];

        if ( $roles ) {
            foreach ( $roles as $role ) {
                $syncableRoles[$role] = [ 'zoo' => $request->get('role_' . $role . '_zoo') ];
            }
        }

        // Prevent removing Administrator role from self
        if ( $user->isAdmin() && $user->id === Auth::user()->id ) {
            $adminRole = Role::getAdminRole();
            $syncableRoles[$adminRole->id] = ['zoo' => null];
        }

        $user->roles()->sync($syncableRoles);

        return redirect()->route('manage.users', ['page' => $request->get('page'), '#user-' . $user->id]);
    }
}
