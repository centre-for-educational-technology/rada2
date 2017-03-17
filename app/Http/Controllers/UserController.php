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
        $this->middleware('auth');
        $this->middleware('auth.admin', ['only' => ['index', 'removeRole', 'assignRoles']]);
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
     * Display User profile page.
     * @param  App\User $user User object
     * @return [type]         Profile view
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);

        return view('profile/show')->with('user', $user);
    }

    /**
     * Display User profile edit page.
     * @param  App\User $user User object
     * @return [type]         Profile edit page
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);

        return view('profile/edit')->with('user', $user);
    }

    /**
     * Update user profile.
     * @param  Illuminate\Http\Request $request Form data
     * @param  App\User                $user    User object
     * @return [type]                           [description]
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $this->validate($request, [
            'name' => 'required|max:255',
            'password' => 'min:6|confirmed',
        ]);

        $attributes = [];

        if ( $request->has('name') )
        {
            $attributes['name'] = $request->get('name');
        }

        if ( $request->has('password') && $request->has('password_confirmation') && $request->get('password') === $request->get('password_confirmation') )
        {
            $attributes['password'] = bcrypt($request->get('password'));
        }

        if ( count($attributes) > 0 )
        {
            $user->update($attributes);
        }

        return redirect()->route('user.profile', [ 'id' => $user->id ]);
    }

    /**
     * Remove role from a user.
     * @param  App\User $user User object
     * @param  App\Role $role Role object
     * @return [type]         [description]
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
     * Assign roles to a user.
     * @param  Illuminate\Http\Request $request Form data
     * @param  App\User                $user    User object
     * @return [type]                           [description]
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
