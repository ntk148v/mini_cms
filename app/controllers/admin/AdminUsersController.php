<?php

class AdminUsersController extends AdminController {


    /**
     * User Model
     * @var User
     */
    protected $user;

    /**
     * Role Model
     * @var Role
     */
    protected $role;

    /**
     * Permission Model
     * @var Permission
     */
    protected $permission;

    /**
     * Inject the models.
     * @param User $user
     * @param Role $role
     * @param Permission $permission
     */
    public function __construct(User $user, Role $role, Permission $permission)
    {
        parent::__construct();
        $this->user = $user;
        $this->role = $role;
        $this->permission = $permission;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        $title = Lang::get('admin/users/title.user_management');

        $users = $this->user;

        return View::make('admin/users/index', compact('users', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
        $roles = $this->role->all();

        $permissions = $this->permission->all();

        $selectedRoles = Input::old('roles', array());

        $selectedPermissions = Input::old('permissions', array());

		$title = Lang::get('admin/users/title.create_a_new_user');

		$mode = 'create';

		return View::make('admin/users/create_edit', compact('roles', 'permissions', 'selectedRoles', 'selectedPermissions', 'title', 'mode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate()
    {
        $destinationPath = '';
        $filename        = '';

        $this->user->username = Input::get( 'username' );
        $this->user->email = Input::get( 'email' );

        if (Input::hasFile('img_path')) {
            $file = Input::file('img_path');
            $destinationPath = 'public/uploads/';                
            $filename = str_random(6) . '_' .$file->getClientOriginalName();
            $uploadSuccess = $file->move($destinationPath,$filename);
            Image::make(sprintf($destinationPath . '%s',$filename))->resize(180,180)->save();
        }

        $this->img_path = $destinationPath . $filename;

        $this->user->password = Input::get( 'password' );

        $this->user->password_confirmation = Input::get( 'password_confirmation' );

        $this->user->confirmation_code = md5(uniqid(mt_rand(), true));

        if (Input::get('confirm')) {
            $this->user->confirmed = Input::get('confirm');
        }

        $this->user->save();

        if ( $this->user->id ) {
            $this->user->saveRoles(Input::get( 'roles' ));

            if (Config::get('confide::signup_email')) {
                $user = $this->user;
                Mail::queueOn(
                    Config::get('confide::email_queue'),
                    Config::get('confide::email_account_confirmation'),
                    compact('user'),
                    function ($message) use ($user) {
                        $message
                            ->to($user->email, $user->username)
                            ->subject(Lang::get('confide::confide.email.account_confirmation.subject'));
                    }
                );
            }

            return Redirect::to('admin/users/' . $this->user->id . '/edit')
                ->with('success', Lang::get('admin/users/messages.create.success'));

        } else {

            $error = $this->user->errors()->all();

            return Redirect::to('admin/users/create')
                ->withInput(Input::except('password'))
                ->with( 'error', $error );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function getShow($user)
    {
        // redirect to the frontend
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function getEdit($user)
    {
        if ( $user->id )
        {
            $roles = $this->role->all();
            $permissions = $this->permission->all();

        	$title = Lang::get('admin/users/title.user_update');
        	
        	$mode = 'edit';

        	return View::make('admin/users/create_edit', compact('user', 'roles', 'permissions', 'title', 'mode'));
        }
        else
        {
            return Redirect::to('admin/users')->with('error', Lang::get('admin/users/messages.does_not_exist'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param User $user
     * @return Response
     */
    public function postEdit($user)
    {
        $oldUser = clone $user;

        $destinationPath = '';
        $filename        = '';

        $user->username = Input::get( 'username' );
        $user->email = Input::get( 'email' );

        if (Input::hasFile('img_path')) {
            $file = Input::file('img_path');
            $destinationPath = 'public/uploads/';                
            $filename = str_random(6) . '_' .$file->getClientOriginalName();
            $uploadSuccess = $file->move($destinationPath,$filename);
            Image::make(sprintf($destinationPath . '%s',$filename))->resize(60,60)->save();
        }

        $user->img_path = $destinationPath . $filename;

        $user->confirmed = Input::get( 'confirm' );

        $password = Input::get( 'password' );
        $passwordConfirmation = Input::get( 'password_confirmation' );

        if(!empty($password)) {
            if($password === $passwordConfirmation) {
                $user->password = $password;
                $user->password_confirmation = $passwordConfirmation;
            } else {
                return Redirect::to('admin/users/' . $user->id . '/edit')->with('error', Lang::get('admin/users/messages.password_does_not_match'));
            }
        }
            
        if($user->confirmed == null) {
            $user->confirmed = $oldUser->confirmed;
        }

        if ($user->save()) {
            $user->saveRoles(Input::get( 'roles' ));
        } else {
            return Redirect::to('admin/users/' . $user->id . '/edit')
                ->with('error', Lang::get('admin/users/messages.edit.error'));
        }

        $error = $user->errors()->all();

        if(empty($error)) {
            return Redirect::to('admin/users/' . $user->id . '/edit')->with('success', Lang::get('admin/users/messages.edit.success'));
        } else {
            return Redirect::to('admin/users/' . $user->id . '/edit')->with('error', Lang::get('admin/users/messages.edit.error'));
        }
    }

    /**
     * Remove user page.
     *
     * @param $user
     * @return Response
     */
    public function getDelete($user)
    {
        $title = Lang::get('admin/users/title.user_delete');

        return View::make('admin/users/delete', compact('user', 'title'));
    }

    /**
     * Remove the specified user from storage.
     *
     * @param $user
     * @return Response
     */
    public function postDelete($user)
    {
        if ($user->id === Confide::user()->id)
        {
            return Redirect::to('admin/users')->with('error', Lang::get('admin/users/messages.delete.impossible'));
        }

        AssignedRoles::where('user_id', $user->id)->delete();

        $id = $user->id;
        $user->delete();

        $user = User::find($id);
        if ( empty($user) )
        {
            return Redirect::to('admin/users')->with('success', Lang::get('admin/users/messages.delete.success'));
        }
        else
        {
            return Redirect::to('admin/users')->with('error', Lang::get('admin/users/messages.delete.error'));
        }
    }

    /**
     * Show a list of all the users formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
        $users = User::leftjoin('assigned_roles', 'assigned_roles.user_id', '=', 'users.id')
                    ->leftjoin('roles', 'roles.id', '=', 'assigned_roles.role_id')
                    ->select(array('users.id', 'users.username','users.email', 'roles.name as rolename', 'users.confirmed', 'users.created_at'));

        return Datatables::of($users)
        ->edit_column('confirmed','@if($confirmed)
                            Yes
                        @else
                            No
                        @endif')

        ->add_column('actions', '<a href="{{{ URL::to(\'admin/users/\' . $id . \'/edit\' ) }}}" class="iframe btn btn-xs btn-default">{{{ Lang::get(\'button.edit\') }}}</a>
                                @if($username == \'admin\')
                                @else
                                    <a href="{{{ URL::to(\'admin/users/\' . $id . \'/delete\' ) }}}" class="iframe btn btn-xs btn-danger">{{{ Lang::get(\'button.delete\') }}}</a>
                                @endif
            ')

        ->remove_column('id')

        ->make();
    }
}
