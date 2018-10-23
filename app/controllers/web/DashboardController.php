<?php
namespace app\controllers\web;

use app\controllers\base as web;
use app\models\core;
use app\models\web as modelWeb;
use View;
use Auth;
use Session;
use Input;
use Redirect;


/**
 * Class DashboardController
 * @extend web\WebBaseController
 * @package app\controllers\web
 */
class DashboardController extends web\WebBaseController
{
    /**
     * @access public
     *
     * Get Dashboard of entrepreneur user
     *
     * @return Response HTML view of 'web.dashboard.index'
     */
    public function index()
    {
        $ideas = modelWeb\IdeaUser::where(
            'user_id',
            Auth::user()->id
        )->get();

        return View::make(
            'web.dashboard.index',
            compact(
                'ideas'
            )
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

            return \Redirect::to(
                '/user/warning'
            )->with(
                'warning',
                'Some thing is wrong here, please try again later.'
            );
        }

        return View::make(
            'web.dashboard.profile',
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
     * @param string $part of 'core_users' table's field name
     * @return Response JSON Data
     */
    public function update($part)
    {
        if (!$part) {

            return \Response::Json(
                array(
                    'status' => 'error',
                    'msg' => 'Some thing is wrong, please contact to administrator!!'
                )
            );
        }

        $user = core\CoreUser::where(
            'id',
            \Auth::user()->id
        )->first();

        if (!$user) {

            return \Response::Json(
                array(
                    'status' => 'error',
                    'msg' => 'Some thing is wrong, please contact to administrator!!'
                )
            );
        }

        if ($part == 'ext' && \Input::hasFile('pic')) {

            $extension = \Input::file('pic')->guessClientExtension();
            $beforeExt = $user->ext;
            $query = $user->update(
                array(
                    'ext' => ".$extension",
                    'modified_by' => \Auth::user()->username,
                    'modified_date' => date('Y-m-d H:i:s')
                )
            );

            if (!$query) {

                return \Response::Json(
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
            \Input::file('pic')->move(
                $destinationPath,
                $picName
            );

            return \Response::Json(
                array(
                    'status' => 'ok',
                    'msg' => 'Change has been updated!!'
                )
            );
        }

        if (($data = trim(\Input::get('value'))) == null) {

            return \Response::Json(
                array(
                    'status' => 'error',
                    'msg' => 'Some thing is wrong, please contact to administrator!!'
                )
            );
        }

        $query = $user->update(
            array(
                $part => $data,
                'modified_by' => \Auth::user()->username,
                'modified_date' => date('Y-m-d H:i:s')
            )
        );

        if ($query) {

            return \Response::Json(
                array(
                    'status' => 'ok',
                    'msg' => 'Configuration has been updated!!'
                )
            );
        }

        return \Response::Json(
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
     * @return Response HTML view of 'web.dashboard.changePass'
     */
    public function getPassChange()
    {
        return View::make(
            'web.dashboard.changePass'
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
     *  @return Redirect to back 'DashboardController@getPassChange' with flash message
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

    /**
     * @access public
     *
     * @return Response HTML view of 'web.dashboard.warning'
     */
    public function warning()
    {
        $warning = '';
        if (\Session::has('warning')) {
            $warning = \Session::get('warning');
        }

        return \View::make(
            'web.dashboard.warning'
        )->with(
            'warning',
            $warning
        );
    }

}
