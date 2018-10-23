<?php
namespace app\controllers\web;

use app\controllers\base;
use app\models\core;
use app\models\super;
use Auth;
use View;
use Input;
use Redirect;
use Validator;
use Hash;
use Session;
use Request;

/**
 * Class LoginController
 *
 * @extends base\WebBaseController
 * @package app\controllers\core
 */
class LoginController extends base\WebBaseController
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
     * @return Redirect to '/core/dashboard'
     * @return Response HTML view of 'core.login'
     */
    public function getLogin()
    {
        if (Auth::check() && Auth::user()->hasRole('visitor')) {

            return Redirect::to(
                '/user/dashboard'
            );
        }

        $widget = core\CorePage::where(
            'type',
            'widget'
        )->where(
            'content_type',
            'post'
        )->first();

        return View::make(
            'web.user.login',
            compact(
                'widget'
            )
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
     * @return Redirect to '/core/'
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
            'UDC'
        )->first();

        if (!$user) {

            return Redirect::back()->withErrors(
                'Username or Password is not valid'
            );
        }

        if (! (Hash::check(Input::get('password'), $user['password']))) {

            return Redirect::back()->withErrors(
                'Password is not valid'
            );
        }

        if (!$user->status) {

            return Redirect::back()->withErrors(
                'You are locked, please contact with administrator'
            );
        }

        if (!$user->confirmed) {
            $configs = super\CMSConfig::all();

            \Config::set('mail.username', $configs[11]->value);
            \Config::set('mail.password', $configs[12]->value);
            \Config::set('mail.host', $configs[13]->value);
            \Config::set('mail.port', $configs[14]->value);

            $address = $configs[15]->value;
            $name = $configs[16]->value;

            try {
                \Mail::send(
                    'web.emailTemplate.emailVerification',
                    array(
                        'name' => $user->fname.' '. $user->lname,
                        'confirmation_code' => $user->confirmation_code,
                        'username' => $user->email
                    ),
                    function($message) use ($address, $name) {
                        $message->from(
                            $address,
                            $name
                        );
                        $message->to(
                            Input::get('username'),
                            Input::get('username')
                        )->subject(
                            'Please verify your email address'
                        );
                    }
                );
            } catch (\Exception $e) {

                $user->delete();

                return Redirect::back()->withErrors(
                    'We are extremely sorry. Some problem arrived suddenly, please try again few times later!!'
                );
            }

            return Redirect::back()->withErrors(
                'Your email is not verified yet. Please check your mail or spam box.'
            );
        }

        if (Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password')))) {

            $user->update(
                [
                    'last_visit_ip' => Request::getClientIp()
                ]
            );

            return Redirect::intended(
                '/user/dashboard'
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
     * @return  Redirect to '/core/login'
     */
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return Redirect::to(
            '/msg'
        )->with(
            'success',
            'You have successfully logout. Thank you!!'
        );
    }

}
