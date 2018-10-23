<?php
namespace app\controllers\super;

use app\controllers\base;
use app\models\core;
use View;
use Input;
use Redirect;
use Auth;
use Response;

/**
 * Class PagesController
 *
 * @extents base\BaseController
 * @package app\controllers\super
 */
class PageController extends base\BaseController
{
    /**
     * @access public
     *
     * @return Response HTML view of 'super.pages.index'
     */
    public function index()
    {
        $pages = core\CorePage::with(
            'sections'
        )->where(
            'type',
            'page'
        )->get();

        $siteUrl = $this->siteUrl();

        return View::make(
            'super.pages.index',
            compact(
                'siteUrl',
                'pages'
            )
        );
    }

    /**
     * @access public
     *
     * 'GET' form for creating new page
     *
     * @return Response HTML partial view of 'super.pages._create'
     */
    public function create()
    {
        return View::make(
            'super.pages._create'
        );
    }

    /**
     * @access public
     *
     * POST data has been verified, if null is found then it is made a error message.
     *
     * Data are being stored inside database table 'core_pages
     *
     * @return Redirect to action 'PageController@index' with flash message
     */
    public function store()
    {
        if (!($title = Input::get('title'))) {

            return Redirect::back()->with(
                'error',
                'Sorry!!, You must write page title.'
            );
        }

        $page = new core\CorePage();
        $page->title = trim($title);
        $page->name = preg_replace('/\s+/', '-', strtolower($title));
        $page->content = json_encode(
            [
                't'     => '',
                'mAuth' => '',
                'mDes'  => '',
                'cTag'  => '',
                'fw'    => 0
            ]
        );
        $page->status = true;
        $page->guid = '';
        $page->uploaded_by = Auth::user()->username;
        $page->uploaded_date = date('Y-m-d H:i:s');
        $page->modified_by = Auth::user()->username;
        $page->modified_date = date('Y-m-d H:i:s');

        try {
            $page->save();
        } catch (\Exception $e) {

            return Redirect::back()->with(
                'error',
                $e->getMessage()
            );
        }

        $page->update(
            array(
                'guid' => '?page='.$page->id
            )
        );

        return Redirect::to(
            '/~super/pages'
        )->with(
            'success',
            'Congratulation!!, "'.$page->title.'" page has been created successfully!!'
        );
    }

    /**
     * @access public
     *
     * Details about the selected page.
     *
     * @param int $pId of page primary id
     * @return Response HTML view of 'super.sections.details' with array 'page'
     */
    public function details($pId)
    {
        if(!$pId) {

            return Redirect::to(
                '/~super/error'
            )->with(
                'error',
                'Some thing is wrong, please contact to administrator!!'
            );
        }

        $page = core\CorePage::where(
            'id',
            $pId
        )->first();

        $seo = json_decode($page->content, true);

        return View::make(
            'super.pages.details',
            compact(
                'page',
                'seo'
            )
        );
    }

    /**
     * @access public
     *
     * Update the page content JSON data
     *
     * @param int $pId of page primary id
     * @param string $part of 'core_pages' table's field name 'content' JSON data
     * @return Response JSON Data
     */
    public function contentUpdate($pId, $part)
    {
        if (!$pId || !$part) {

            return Response::Json(
                array(
                    'status' => 'error',
                    'msg' => 'Some thing is wrong, please contact to administrator!!'
                )
            );
        }

        $page = core\CorePage::where(
            'id',
            $pId
        )->first();

        if (!$page) {

            return Response::Json(
                array(
                    'status' => 'error',
                    'msg' => 'Some thing is wrong, please contact to administrator!!'
                )
            );
        }

        $data = trim(Input::get('value'));
        $arr = json_decode($page->content, true);

        if ($part == 't') {
            $arr = json_encode(
                [
                    't'     => $data == null? '' : $data,
                    'mAuth' => $arr['mAuth'],
                    'mDes'  => $arr['mDes'],
                    'cTag'  => $arr['cTag'],
                    'fw'    => $arr['fw']
                ]
            );
        }

        if ($part == 'mAuth') {
            $arr = json_encode(
                [
                    't'     => $arr['t'],
                    'mAuth' => $data == null? '' : $data,
                    'mDes'  => $arr['mDes'],
                    'cTag'  => $arr['cTag'],
                    'fw'    => $arr['fw']
                ]
            );
        }

        if ($part == 'mDes') {
            $arr = json_encode(
                [
                    't'     => $arr['t'],
                    'mAuth' => $arr['mAuth'],
                    'mDes'  => $data == null? '' : $data,
                    'cTag'  => $arr['cTag'],
                    'fw'    => $arr['fw']
                ]
            );

        }

        if ($part == 'cTag') {
            $arr = json_encode(
                [
                    't'     => $arr['t'],
                    'mAuth' => $arr['mAuth'],
                    'mDes'  => $arr['mDes'],
                    'cTag'  => $data == null? '' : $data,
                    'fw'    => $arr['fw']
                ]
            );

        }

        if ($part == 'fw') {
            $arr = json_encode(
                [
                    't'     => $arr['t'],
                    'mAuth' => $arr['mAuth'],
                    'mDes'  => $arr['mDes'],
                    'cTag'  => $arr['cTag'],
                    'fw'    => $data == null? '' : $data
                ]
            );

        }


        $query = $page->update(
            array(
                'content' => $arr,
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

}