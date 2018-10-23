<?php
namespace app\controllers\super;

use Illuminate\Routing\Controller;
use app\models\core;
use Auth;
use View;
use Input;
use Redirect;
use Validator;
use Hash;
use Session;

/**
 * Class LoginController
 *
 * @extends Controller
 * @package app\controllers\super
 */
class LoginController extends Controller
{
    /**
     * @access public
     *
     * Checking by Auth detecting user logged in or not!
     *
     * If user already logged in then redirect to direct home dashboard,
     *
     * If not then redirect to login page.
     *
     * @return Redirect to '/~super/'
     * @return Response HTML view of 'super.login'
     */
    public function getLogin()
    {
        if (Auth::check()) {

            return Redirect::to(
                '/~super/'
            );
        }

        return View::make(
            'super.login'
        );
    }

    /**
     * @access public
     *
     * POST data are user's email and password
     *
     * Validation checked by laravel validator class
     *
     * if validation failed it will redirect back to login page.
     *
     * User credentials are checked by storage credential and if it is failed to match,
     *
     * So it will redirect back to login page with error message.
     *
     * If Successfully matched the credential, Auth attempt() method intended to redirect the user to Dashboard home
     *
     *
     * @return Redirect back to login page with validation message
     * @return Redirect to '/~super/'
     */
    public function postLogin()
    {
        $data = Input::all();

        $rules = array(
            'username' => 'required',
            'password' => 'required'
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

        $user = core\CoreUser::where(
            'username',
            Input::get('username')
        )->where(
            'user_type',
            'SC'
        )->first();

        if (!$user) {

            return Redirect::back()->withErrors(
                'Username or Password is not valid'
            );
        }

        if (! (Hash::check(Input::get('password'), $user['password']))) {

            return Redirect::back()->withErrors(
                'Username or Password is not valid'
            )->withInput();
        }

        if (Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password')))) {

            return Redirect::intended(
                '/~super/'
            );
        }

        return Redirect::back()->withErrors(
            'Username or Password is not valid'
        );

    }

    /**
     * @access public
     *
     * Auth class call the logout method and also session flash method
     *
     * which are destroy all session data
     *
     * @return  Redirect to '/~super/login'
     */
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return Redirect::to(
            '/~super/login'
        );
    }

}
