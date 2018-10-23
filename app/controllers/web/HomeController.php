<?php
namespace app\controllers\web;

use app\controllers\base as web;
use app\models\core;
use app\models\super;
use View;
use Session;
use Auth;
use Redirect;

/**
 * Class HomeController
 * @extend web\WebBaseController
 * @package app\controllers\web
 */
class HomeController extends web\WebBaseController
{
    /**
     * @access public
     *
     * @return html page
     */
    public function index()
    {
        $getConfig = super\CMSConfig::all();

        $page = core\CorePage::with(
            array(
                'sections' => function ($q) {
                    $q->with(
                        'items'
                    )->where(
                        'status',
                        1
                    );
                }
            )

        )->where(
            'id',
            $getConfig[2]->value
        )->first();

        if (!$page) {

            $msg = "Page is not found. please contact to administrator!!";
            return View::make(
                '404',
                compact(
                    'msg'
                )
            );
        }

        if ($page->id == $getConfig[4]->value) {
            if (\Auth::check() && \Auth::user()->hasRole('visitor')) {

                return \Redirect::to(
                    '/user/dashboard'
                );
            }
        }

        $arr = json_decode($page->content, true);
        $pageTitle = $arr['t'] == ''? $page->title : $arr['t'];

        $widget = [
            'on' => false,
            'content' => ''
        ];
        if ($arr['fw']) {
            $widget['on'] = true;
            $widget['content'] = core\CorePage::where(
                'type',
                'widget'
            )->where(
                'content_type',
                'post'
            )->first();
        }

        $sections = [];
        foreach ($page->sections as $key => $sec) {
            $secArr = [
                'layout' => json_decode($sec->content, true),
                'secId' => $sec->id
            ];
            array_push($sections, $secArr);
            $itemContents[$sec->id] = [];
            foreach ($sec->items as $key => $item) {
                $contentArr = [
                    'layout' => json_decode($item->content, true),
                    'type' => $item->content_type,
                    'itemId' => $item->id,
                    'contents' => $this->contents($item->content_type, $item->id)
                ];
                array_push($itemContents[$sec->id], $contentArr);
            }
        }

        return View::make(
            'web.index',
            compact(
                'sections',
                'itemContents',
                'pageTitle',
                'widget',
                'arr'
            )
        );
    }

    /**
     * @access private
     *
     * @param string $type of the content type
     * @param int $parent_id of 'core_pages' table
     * @return string class name
     */
    private function contents($type, $parent_id)
    {
        switch ($type) {
            case 'slider' :
                return core\CoreSlider::where(
                    'item_id',
                    $parent_id
                )->where(
                    'status',
                    1
                )->orderBy(
                    'order_no',
                    'asc'
                )->get();
            case 'post' :
                return core\CorePage::where(
                    'parent_id',
                    $parent_id
                )->where(
                    'status',
                    1
                )->where(
                    'type',
                    'content'
                )->where(
                    'content_type',
                    'post'
                )->get();
            case 'news' :
                return core\CorePage::where(
                    'parent_id',
                    $parent_id
                )->where(
                    'status',
                    1
                )->where(
                    'type',
                    'content'
                )->where(
                    'content_type',
                    'news'
                )->orderBy(
                    'id',
                    'desc'
                )->take(
                    3
                )->get();
            case 'gallery' :
                return core\CorePage::where(
                    'parent_id',
                    $parent_id
                )->where(
                    'status',
                    1
                )->where(
                    'type',
                    'content'
                )->where(
                    'content_type',
                    'gallery'
                )->orderBy(
                    'id',
                    'asc'
                )->get();
            case 'profile' :
                return core\CorePage::where(
                    'parent_id',
                    $parent_id
                )->where(
                    'status',
                    1
                )->where(
                    'type',
                    'content'
                )->where(
                    'content_type',
                    'profile'
                )->orderBy(
                    'section_order',
                    'asc'
                )->get();
            case 'banner' :
                return core\CorePage::where(
                    'parent_id',
                    $parent_id
                )->where(
                    'status',
                    1
                )->where(
                    'type',
                    'content'
                )->where(
                    'content_type',
                    'banner'
                )->first();
            case 'cForm' :
                return core\CorePage::where(
                    'parent_id',
                    $parent_id
                )->where(
                    'status',
                    1
                )->where(
                    'type',
                    'content'
                )->where(
                    'content_type',
                    'cForm'
                )->get();
            default:
                return core\CorePage::where(
                    'parent_id',
                    $parent_id
                )->where(
                    'status',
                    1
                )->where(
                    'type',
                    'content'
                )->where(
                    'content_type',
                    'post'
                )->get();
        }
    }

    /**
     * @access public
     *
     * @param string $name of the page
     * @return html page
     */
    public function part($name = 'home')
    {
        $getConfig = super\CMSConfig::all();

        $page = core\CorePage::with(
            array(
                'sections' => function ($q) {
                    $q->with(
                        'items'
                    )->where(
                        'status',
                        1
                    );
                }
            )

        )->where(
            'name',
            $name
        )->first();

        if (!$page) {

            $msg = "Page is not found. please contact to administrator!!";
            return \Redirect::to(
                '/error'
            )->with(
                'error',
                $msg
            );
        }

        if ($page->id == $getConfig[4]->value) {
            if (\Auth::check() && \Auth::user()->hasRole('visitor')) {

                return \Redirect::to(
                    '/user/dashboard'
                );
            }
        }

        $arr = json_decode($page->content, true);
        $pageTitle = $arr['t'] == ''? $page->title : $arr['t'];

        $widget = [
            'on' => false,
            'content' => ''
        ];
        if ($arr['fw']) {
            $widget['on'] = true;
            $widget['content'] = core\CorePage::where(
                'type',
                'widget'
            )->where(
                'content_type',
                'post'
            )->first();
        }

        $sections = [];
        foreach ($page->sections as $key => $sec) {
            $secArr = [
                'layout' => json_decode($sec->content, true),
                'secId' => $sec->id
            ];
            array_push($sections, $secArr);
            $itemContents[$sec->id] = [];
            foreach ($sec->items as $key => $item) {
                $contentArr = [
                    'layout' => json_decode($item->content, true),
                    'type' => $item->content_type,
                    'itemId' => $item->id,
                    'contents' => $this->contents($item->content_type, $item->id)
                ];
                array_push($itemContents[$sec->id], $contentArr);
            }
        }

        return View::make(
            'web.index',
            compact(
                'sections',
                'itemContents',
                'pageTitle',
                'widget',
                'arr'
            )
        );
    }

    /**
     * @access public
     *
     * @param int $id of the profile
     * @return html page
     */
    public function profile($id)
    {
        if (!$id) {

            $msg = "Page is not found. please contact to administrator!!";
            return \Redirect::to(
                '/error'
            )->with(
                'error',
                $msg
            );
        }

        $prf = core\CorePage::where(
            'id',
            $id
        )->where(
            'type',
            'content'
        )->where(
            'content_type',
            'profile'
        )->first();

        if (!$prf) {

            $msg = "Page is not found. please try again with valid query, thank you!!";
            return \Redirect::to(
                '/error'
            )->with(
                'error',
                $msg
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
            'web.profile',
            compact(
                'prf',
                'widget'
            )
        );
    }

    /**
     * @access public
     *
     * Web visitor submit contact form
     *
     * @return html page
     */
    public function contact()
    {
        $data = \Input::all();

        $rules = array(
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|max:20',
            'msg' => 'required',
        );

        $messages = array(
            'name.required'  => 'Your name is required!!',
            'email.required' => 'Your email address is required',
            'email.email'    => 'Valid email address required!!',
            'mobile.required'=> 'Your mobile number is required!!',
            'mobile.max'     => 'Your mobile number should be in between 20 digit!!',
            'msg'            => 'Please write message!!',
        );

        $validator = \Validator::make(
            $data,
            $rules,
            $messages
        );

        if ($validator->fails()) {

            return \Redirect::back()->withErrors(
                $validator
            )->withInput();
        }

        $configs = super\CMSConfig::all();

        \Config::set('mail.username', $configs[11]->value);
        \Config::set('mail.password', $configs[12]->value);
        \Config::set('mail.host', $configs[13]->value);
        \Config::set('mail.port', $configs[14]->value);

        $address = $configs[15]->value;
        $name = $configs[16]->value;
        $mailTo = $configs[17]->value;

        try {
            \Mail::send(
                'web.emailTemplate.contactEmail',
                array(
                    'name' => trim(\Input::get('name')),
                    'email' => trim(\Input::get('email')),
                    'mobile' => trim(\Input::get('mobile')),
                    'msg' => trim(\Input::get('msg'))
                ),
                function($message) use($address, $name, $mailTo) {
                    $message->from(
                        $address,
                        $name
                    );
                    $message->to(
                        $mailTo
                    )->subject(
                        'Client submitted from GET IN TOUCH'
                    );
                }
            );
        } catch (\Exception $e) {

            return \Redirect::back()->with(
                'error',
                'We are extremely sorry. Some problem arrived suddenly, please try again few times later!!'
            );
        }

        return \Redirect::back()->with(
            'success',
            'Thanks for your request. We will get back to you very soon.'
        );
    }

    /**
     * @access public
     *
     * @return Response HTML view of 'web.error'
     */
    public function error()
    {
        $error = '';
        if (Session::has('error')) {
            $error = Session::get('error');
        }

        $widget = core\CorePage::where(
            'type',
            'widget'
        )->where(
            'content_type',
            'post'
        )->first();

        return View::make(
            'web.error',
            compact(
              'widget'
            )
        )->with(
            'error',
            $error
        );
    }

    /**
     * @access public
     *
     * @return Response HTML view of 'web.msg'
     */
    public function msg()
    {
        $msg = '';
        $state = '';
        if (Session::has('error')) {
            $state = 'error';
            $msg = Session::get('error');
        }

        if (Session::has('success')) {
            $state = 'success';
            $msg = Session::get('success');
        }

        if (!$state) {
            return \Redirect::to(
                '/'
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
            'web.msg',
            compact(
                'state',
                'msg',
                'widget'
            )
        );
    }

}
