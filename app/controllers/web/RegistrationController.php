<?php
namespace app\controllers\web;

use app\controllers\base;
use app\models\super;
use app\models\core;
use app\models\entrust;
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
class RegistrationController extends base\WebBaseController
{
    /**
     * @access public
     *
     * GET request for form of user registration
     *
     * @return Response HTML view of 'web.user.regi'
     */
    public function create()
    {
        $widget = core\CorePage::where(
            'type',
            'widget'
        )->where(
            'content_type',
            'post'
        )->first();

        return View::make(
            'web.user.regi',
            compact(
                'widget'
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
     * @return Redirect to action 'HomeController@msg' with flash message
     */
    public function store()
    {
        $data = Input::all();

        $rules = array(
            'fname' => 'required|max:100',
            'lname' => 'required|max:50',
            'company' => 'required|max:100',
            'designation' => 'required|max:100',
            'mobile' => 'required|max:20',
            'email' => 'email|required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
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
        $user = new core\CoreUser();
        $user->fname = trim(Input::get('fname'));
        $user->lname = trim(Input::get('lname'));
        $user->username = $email;
        $user->email = $email;
        $user->password = Hash::make(
            trim(Input::get('password'))
        );
        $user->mobile = trim(Input::get('mobile'));
        $user->company = trim(Input::get('company'));
        $user->designation = trim(Input::get('designation'));
        $user->path = '/upload/users/';
        $user->user_type = 'UDC';
        $user->confirmed = false;
        $user->confirmation_code = str_random(30);
        $user->status = true;
        $user->uploaded_by = 'FROM_WEB';
        $user->uploaded_date = date('Y-m-d H:i:s');
        $user->modified_by = 'FROM_WEB';
        $user->modified_date = date('Y-m-d H:i:s');

        try {
            $user->save();
        } catch (\Exception $e) {

            return Redirect::back()->with(
                'error',
                $user->username.' is already exist, please try another email or user name !!'
            );
        }

        $roleId = entrust\Role::where(
            'type',
            'UDC'
        )->where(
            'name',
            'visitor'
        )->first();

        if ($roleId->id) {
            $user->roles()->attach($roleId);
        }

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
                function($message) use($address, $name) {
                    $message->from(
                        $address,
                        $name
                    );
                    $message->to(
                        Input::get('email'),
                        Input::get('email')
                    )->subject(
                        'Please verify your email address'
                    );
                }
            );
        } catch (\Exception $e) {

            $user->delete();
            $e->getMessage();
            return Redirect::back()->with(
                'error',
                'We are extremely sorry. Some problem arrived suddenly, please try again few times later!!'
            );
        }

        return Redirect::to(
            '/msg'
        )->with(
            'success',
            $user->username.' has been created successfully, thank you for registration at our portal. Please go to email account for verifying your email !!'
        );
    }

    /**
     * @access public
     *
     * Completed the registration process by email verifying the verification code
     *
     * @return Redirect to action 'HomeController@msg' with flash message
     */
    public function codeVerified()
    {
        $code = trim(Input::get('code'));
        $userName = trim(Input::get('username'));
        if(!$code || !$userName) {

            return Redirect::to(
                '/msg'
            )->with(
                'error',
                'Your requested verification code does not found, please click again.'
            );
        }

        $user = core\CoreUser::where(
            'username',
            $userName
        )->where(
            'confirmation_code',
            $code
        )->first();

        if (!$user) {
            return Redirect::to(
                '/msg'
            )->with(
                'error',
                'Your requested verification code does not found, please click again.'
            );
        }

        if ($user->confirmed) {
            return Redirect::to(
                '/msg'
            )->with(
                'success',
                'Your email is already verified, please login from entrepreneur zone. Thank you!!'
            );
        }

        $query = $user->update(
            [
                'confirmed' => true
            ]
        );

        if (!$query) {

            return Redirect::to(
                '/msg'
            )->with(
                'error',
                'We are extremely sorry. Some problem arrived suddenly, please try again few times later!!'
            );
        }

        $configs = super\CMSConfig::all();

        \Config::set('mail.username', $configs[11]->value);
        \Config::set('mail.password', $configs[12]->value);
        \Config::set('mail.host', $configs[13]->value);
        \Config::set('mail.port', $configs[14]->value);

        $address = $configs[15]->value;
        $name = $configs[16]->value;

        \Mail::send(
            'web.emailTemplate.afterVerifiedEmail',
            array(
                'name' => $user->fname.' '. $user->lname,
                'fb' => $configs[7]->value,
                'tw' => $configs[8]->value,
                'ld' => $configs[9]->value
            ),
            function($message) use($address, $name) {
                $message->from(
                    $address,
                    $name
                );
                $message->to(
                    Input::get('username'),
                    Input::get('username')
                )->subject(
                    'Complete registration process'
                );
            }
        );

        return Redirect::to(
            '/msg'
        )->with(
            'success',
            'Your email has been verified now, please login from entrepreneur zone. Thank you!!'
        );
    }

    /**
     * @access public
     *
     * Email address verified and send a mail with a link
     *
     * @return Redirect to action 'HomeController@msg' with flash message
     */
    public function forgotten()
    {
        if (!($email = \Input::get('email'))) {

            return Redirect::to(
                '/msg'
            )->with(
                'error',
                'Your requested email address is not found, please try again.'
            );
        }

        $user = core\CoreUser::where(
            'email',
            $email
        )->first();

        if ($user) {

            return Redirect::to(
                '/msg'
            )->with(
                'error',
                'Your requested email address is not valid, please try again with valid email address!!'
            );
        }

        $code = str_random(30);

        $query = $user->update(
            [
                'password_reset_token' => $code
            ]
        );

        if (!$query) {

            return Redirect::to(
                '/msg'
            )->with(
                'error',
                'We are extremely sorry. Some problem arrived suddenly, please try again few times later!!'
            );
        }

        $configs = super\CMSConfig::all();

        \Config::set('mail.username', $configs[11]->value);
        \Config::set('mail.password', $configs[12]->value);
        \Config::set('mail.host', $configs[13]->value);
        \Config::set('mail.port', $configs[14]->value);

        $address = $configs[15]->value;
        $name = $configs[16]->value;

        \Mail::send(
            'web.emailTemplate.forgottenPass',
            array(
                'name' => $user->fname.' '. $user->lname,
                'username' => $email,
                'code' => $code
            ),
            function($message) use($address, $name) {
                $message->from(
                    $address,
                    $name
                );
                $message->to(
                    Input::get('email'),
                    Input::get('email')
                )->subject(
                    'Forgotten Password'
                );
            }
        );

        return Redirect::to(
            '/msg'
        )->with(
            'success',
            'Your request has been accepted and sent you a link for further processing to your mail account. Please check your email account. Thank you!!'
        );
    }

    /**
     * @access public
     *
     * After clicked the link, gets the password_reset_token and verified it.
     *
     * Valid token permit to do the change password. Invalid token redirect to '/msg with error message.
     *
     * @return Redirect to action 'HomeController@msg' with flash message
     */
    public function getChangePass()
    {
        $code = trim(Input::get('code'));
        $userName = trim(Input::get('username'));
        if(!$code || !$userName) {

            return Redirect::to(
                '/msg'
            )->with(
                'error',
                'Your requested verification code does not found, please click again.'
            );
        }

        $user = core\CoreUser::where(
            'username',
            $userName
        )->where(
            'password_reset_token',
            $code
        )->first();

        if (!$user) {

            return Redirect::to(
                '/msg'
            )->with(
                'error',
                'Your requested verification code is invalid. Please make a request again. Thank you.'
            );
        }

        $query = $user->update(
            [
                'password_reset_token' => null
            ]
        );

        if (!$query) {

            return Redirect::to(
                '/msg'
            )->with(
                'error',
                'We are extremely sorry. Some problem arrived suddenly, please try again few times later!!'
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
            'web.user.forgotten',
            compact(
                'user',
                'widget'
            )
        );
    }

    /**
     * @access public
     *
     * After clicked the link, gets the password_reset_token and verified it.
     *
     * Valid token permit to do the change password. Invalid token redirect to '/msg with error message.
     *
     * @return Redirect to action 'HomeController@msg' with flash message
     */
    public function postChangePass()
    {
        $data = \Input::all();
        $email = \Input::get('email');

        $rules = array(
            'email' => 'email|required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        );

        $validator = \Validator::make(
            $data,
            $rules
        );

        if ($validator->fails()) {

            if (!$email) {

                \Session::flash(
                    'error',
                    'We are extremely sorry. Some problem arrived suddenly, please try again few times later!!'
                );
            }

            return Redirect::back()->withErrors(
                $validator
            )->withInput();
        }

        $query = core\CoreUser::where(
            'username',
            $email
        )->update(
            [
               'password' => \Hash::make(trim(Input::get('password')))
            ]
        );

        if (!$query) {

            return Redirect::to(
                '/msg'
            )->with(
                'error',
                'We are extremely sorry. Some problem arrived suddenly, please try again few times later!!'
            );
        }

        return Redirect::to(
            '/msg'
        )->with(
            'success',
            'Your password has been changed. Please login with new password. Thank you!!'
        );
    }

}
