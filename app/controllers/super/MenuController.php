<?php
namespace app\controllers\super;

use app\controllers\base;
use app\models\core;
use View;
use Input;
use Redirect;
use Validator;
use Response;
use Auth;

/**
 * Class MenuController
 *
 * @extents base\BaseController
 * @package app\controllers\super
 */
class MenuController extends base\BaseController
{
    /**
     * @access public
     *
     * @return Response HTML view of 'super.menu.index'
     */
    public function index()
    {
        $menu = core\CorePage::with(
            'page'
        )->where(
            'type',
            'menu'
        )->get();

        $siteUrl = $this->siteUrl();

        return View::make(
            'super.menu.index',
            compact(
                'siteUrl',
                'menu'
            )
        );
    }

    /**
     * @access public
     *
     * 'GET' form for creating new menu
     *
     * @return Response HTML partial view of 'super.menu._create'
     */
    public function create()
    {
        $pages = core\CorePage::where(
            'type',
            'page'
        )->lists(
            'title',
            'id'
        );

        return View::make(
            'super.menu._create',
            compact(
                'pages'
            )
        );
    }

    /**
     * @access public
     *
     * POST data has been verified, if null is found then it is made a error message.
     *
     * Data are being stored inside database table 'core_pages
     *
     * @return Redirect to action 'MenuController@index' with flash message
     */
    public function store()
    {
        $data = Input::all();

        $rules = array(
            'page'  => 'required',
            'order' => 'required',
            'title' => 'required'
        );

        $validator = Validator::make(
            $data,
            $rules
        );

        if ($validator->fails()) {

            return Redirect::back()->with(
                'error',
                'Error!! Some of fields are missing, please fill up!!'
            );
        }

        $pageId = trim(Input::get('page'));
        $order = trim(Input::get('order'));
        $title = trim(Input::get('title'));

        $menu = new core\CorePage();
        $menu->title = $title;
        $menu->parent_id = $pageId;
        $menu->name = preg_replace('/\s+/', '-', strtolower($title));
        $menu->type = 'menu';
        $menu->content_type = 'link';
        $menu->status = true;
        $menu->menu_order = $order;
        $menu->guid = '';
        $menu->uploaded_by = Auth::user()->username;
        $menu->uploaded_date = date('Y-m-d H:i:s');
        $menu->modified_by = Auth::user()->username;
        $menu->modified_date = date('Y-m-d H:i:s');

        try {
            $menu->save();
        } catch (\Exception $e) {

            return Redirect::back()->with(
                'error',
                $e->getMessage()
            );
        }

        $pageName = core\CorePage::where(
            'id',
            $pageId
        )->pluck(
            'name'
        );

        $menu->update(
            array(
                'guid' => $pageName
            )
        );

        return Redirect::to(
            '/~super/pages/menu'
        )->with(
            'success',
            'Congratulation!!, "'.$menu->title.'" menu has been created successfully!!'
        );
    }

}
