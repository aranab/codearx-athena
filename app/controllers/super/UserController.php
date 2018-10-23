<?php
namespace app\controllers\super;

use app\controllers\base;
use app\models\core;
use app\models\entrust;
use View;
use Input;
use Redirect;
use Validator;
use Response;
use Hash;
use Auth;

/**
 * Class UserController
 *
 * @extends base\BaseController
 * @package app\controllers\super
 */
class UserController extends base\BaseController
{
    /**
     * @access public
     *
     * GET a list of users show in grid data table.
     *
     * @return Response HTML view of 'super.users.index' with array of 'users'
     */
    public function index()
    {
        $users = core\CoreUser::with(
            'roles'
        )->get();

        return View::make(
            'super.users.index',
            compact(
                'users'
            )
        );
    }

    /**
     * @access public
     *
     * 'GET' form for creating new user
     *
     * @return Response HTML view of 'super.users.create'
     */
    public function create()
    {
        return View::make(
            'super.users.create'
        );
    }

    /**
     * @access public
     *
     * Ajax request get the roles list of particular user type
     *
     * @return Response JSON array of 'rolesList'
     */
    public function rolesList()
    {
        if (!($type = input::get('type'))) {

            return Response::json(
                'error'
            );
        }

        $rolesList = entrust\Role::where(
            'type',
            $type
        )->get(
            array(
                'id',
                'name'
            )
        );

        if ($rolesList->isEmpty()) {

            return Response::json(
                'error'
            );
        }

        $id = [];
        $name = [];
        foreach ($rolesList as $role) {
            array_push($id, $role->id);
            array_push($name, $role->name);
        }

        return Response::json(
            array(
                'id' => $id,
                'name' => $name
            )
        );
    }

    /**
     * @access public
     *
     * POST data are verified by laravel validator class
     *
     * Failed validator is redirect back to with flash message
     *
     * Data are being stored inside database table 'core_users'
     *
     * @return Redirect to action 'UserController@index' with flash message
     */
    public function store()
    {
        $data = Input::all();

        $rules = array(
            'email' => 'email|required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'mobile' => 'required',
            'type' => 'required',
        );

        $validator = Validator::make(
            $data,
            $rules
        );

        if ($validator->fails()) {

            return Redirect::back()->withErrors(
                $validator
            )->withInput();
        }

        $email = trim(Input::get('email'));
        $roles = Input::get('roles');

        if (!$roles) {

            return Redirect::back()->with(
                'error',
                'Sorry!!, You must select at least one role assign to user.'
            );
        }

        $user = new core\CoreUser();
        $user->username = $email;
        $user->email = $email;
        $user->password = Hash::make(
            trim(Input::get('password'))
        );
        $user->mobile = trim(Input::get('mobile'));
        $user->path = '/upload/users/';
        $user->user_type = trim(Input::get('type'));
        $user->confirmed = true;
        $user->status = true;
        $user->uploaded_by = Auth::user()->username;
        $user->uploaded_date = date('Y-m-d H:i:s');
        $user->modified_by = Auth::user()->username;
        $user->modified_date = date('Y-m-d H:i:s');

        try {
            $user->save();
        } catch (\Exception $e) {

            return Redirect::back()->with(
                'error',
                $user->username.' user is already exist, please try another email or user name !!'
            );
        }

        foreach ($roles as $role) {
            $user->roles()->attach($role);
        }

        return Redirect::to(
            '/~super/users'
        )->with(
            'success',
            'Congratulation!!, '.$user->username.' user has been created successfully!!'
        );
    }
}