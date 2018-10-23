<?php
namespace app\controllers\core;

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
 * @extends base\CoreController
 * @package app\controllers\core
 */
class UserController extends base\CoreController
{
    /**
     * @access public
     *
     * GET a list of users show in grid data table.
     *
     * @return Response HTML view of 'core.user.users' with array of 'users'
     */
    public function index()
    {
        $users = core\CoreUser::with(
            'roles'
        )->where(
            'user_type',
            '!=',
            'SC'
        )->get();

        return View::make(
            'core.users.users',
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
     * @return Response HTML view of 'core.user.create'
     */
    public function create()
    {
        return View::make(
            'core.users.create'
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
            'mobile' => 'required|max:20',
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
                'Sorry!!, You must select at least one role assign to user'
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

        try {
            $user->save();
        } catch (\Exception $e) {

            return Redirect::back()->with(
                'error',
                $user->username.' is already exist, please try another email or user name !!'
            );
        }

        foreach ($roles as $role) {
            $user->roles()->attach($role);
        }

        return Redirect::to(
            '/core/users'
        )->with(
            'success',
            'Congratulation!!, '.$user->username.' has been created successfully!!'
        );
    }

    /**
     * @access public
     *
     * Get log in user profile information for edit,
     *
     * user id get from Auth user method
     *
     * @return Response HTML view of 'core.profile' with array of 'userInfo'
     */
    public function profile()
    {
        $userInfo = core\CoreUser::where(
            'id',
            Auth::user()->id
        )->first();

        if (!$userInfo) {

            return redirect::to(
                'core/error'
            )->with(
                'error',
                'Some thing is wrong here, please try again later.'
            );
        }

        return View::make(
            'core.users.profile',
            compact(
                'userInfo'
            )
        );
    }

    /**
     * @access public
     *
     * Get user profile information for edit,
     *
     * @param int $userId of user primary key
     * @return Response HTML view of 'core.profile' with array of 'userInfo'
     */
    public function userProfile($userId)
    {
        if (!$userId) {

            return redirect::to(
                'core/error'
            )->with(
                'error',
                'User is not found!!'
            );
        }

        $userInfo = core\CoreUser::where(
            'id',
            $userId
        )->first();

        if (!$userInfo) {

            return redirect::to(
                'core/error'
            )->with(
                'error',
                'Some thing is wrong here, please try again later.'
            );
        }

        return View::make(
            'core.users.profile',
            compact(
                'userInfo'
            )
        );
    }

    /**
     * @access public
     *
     * Update the user profile information
     *
     * @param int $userId of user primary id
     * @param string $part of 'core_users' table's field name
     * @return Response JSON Data
     */
    public function update($userId, $part)
    {
        if (!$userId || !$part) {

            return Response::Json(
                array(
                    'status' => 'error',
                    'msg' => 'Some thing is wrong, please contact to administrator!!'
                )
            );
        }

        $user = core\CoreUser::where(
            'id',
            $userId
        )->first();

        if (!$user) {

            return Response::Json(
                array(
                    'status' => 'error',
                    'msg' => 'Some thing is wrong, please contact to administrator!!'
                )
            );
        }

        if ($part == 'ext' && Input::hasFile('pic')) {

            $extension = Input::file('pic')->guessClientExtension();
            $beforeExt = $user->ext;
            $query = $user->update(
                array(
                    'ext' => ".$extension",
                    'modified_by' => Auth::user()->username,
                    'modified_date' => date('Y-m-d H:i:s')
                )
            );

            if (!$query) {

                return Response::Json(
                    array(
                        'status' => 'error',
                        'msg' => 'Some thing is wrong, please contact to administrator!!'
                    )
                );
            }

            $destinationPath = public_path().$user->path;
            $picName = $user->id.".$extension";
            if ($beforeExt) {
                \File::Delete($destinationPath.$user->id.$beforeExt);
            }
            Input::file('pic')->move(
                $destinationPath,
                $picName
            );

            return Response::Json(
                array(
                    'status' => 'ok',
                    'msg' => 'Change has been updated!!'
                )
            );
        }

        if (($data = trim(Input::get('value'))) == null) {

            return Response::Json(
                array(
                    'status' => 'error',
                    'msg' => 'Some thing is wrong, please contact to administrator!!'
                )
            );
        }

        $query = $user->update(
            array(
                $part => $data,
                'modified_by' => Auth::user()->username,
                'modified_date' => date('Y-m-d H:i:s')
            )
        );

        if ($query) {

            return Response::Json(
                array(
                    'status' => 'ok',
                    'msg' => 'Configuration has been updated!!'
                )
            );
        }

        return Response::Json(
            array(
                'status' => 'error',
                'msg' => 'Some thing is wrong, please contact to administrator!!'
            )
        );
    }

    /**
     * @access public
     *
     * GET a form for changing password
     *
     * @return Response HTML view of 'core.users.changePass'
     */
    public function getPassChange()
    {
        return View::make(
            'core.users.changePass'
        );
    }

    /**
     * @access public
     *
     * POST data are verified by laravel validator class
     *
     * Failed validator is redirected back to with flash message
     *
     * Has been checked new password and old password.
     * If these password are not same redirect back to with flash message
     *
     * Password is being updated inside database table 'core_users'
     *
     *  @return Redirect to back 'UserController@getPassChange' with flash message
     */
    public function postPassChange()
    {
        $data = \Input::all();

        $rules = array(
            'password' => 'required|min:5',
            'old_password' => 'required',
            'confirm_password' => 'required|same:password'
        );

        $validator = \Validator::make(
            $data,
            $rules
        );

        if ($validator->fails()) {
            return \Redirect::back()->withErrors(
                $validator
            )->withInput();
        }

        $coreUser = core\CoreUser::where(
            'id',
            \Auth::user()->id
        )->first();

        if (!$coreUser) {
            return Redirect::back()->with(
                'error',
                'Something is wrong. Please try again later.'
            );
        }

        $oldPassword = \Input::get('old_password');
        $password = \Input::get('password');

        if ($oldPassword == $password) {
            return Redirect::back()->with(
                'error',
                'Old password and New Password are same. Please enter different new password'
            );
        }

        if (
        !\Hash::check(
            $oldPassword,
            $coreUser->password
        )
        ) {
            return Redirect::back()->with(
                'error',
                'Your old password is incorrect.'
            );
        }

        $coreUser->password = \Hash::make($password);
        $coreUser->modified_by = \Auth::user()->username;
        $coreUser->modified_date = date('Y-m-d H:i:s');

        try {
            $coreUser->save();
        } catch (\Exception $e) {
            return Redirect::back()->with(
                'error',
                'We are extremely sorry. Some problem arrived suddenly, please try again few times later!!'
            );
        }

        return Redirect::back()->with(
            'success',
            'Your password has been changed. Please login with new password. Thank you!!'
        );
    }

}
