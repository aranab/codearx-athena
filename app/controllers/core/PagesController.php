<?php
namespace app\controllers\core;

use app\controllers\base;
use app\models\core;
use View;
use Session;
use Redirect;
use Input;
use Auth;
use Response;

/**
 * Class PagesController
 *
 * @extends base\CoreController
 * @package app\controllers\core
 */
class PagesController extends base\CoreController
{
    /**
     * @access public
     *
     * Get all pages with its sections list
     *
     * @return Response HTML view of 'core.pages.index'
     */
    public function index()
    {
        $pages = core\CorePage::with(
            array(
                'sections' => function ($q) {
                    $q->with(
                        'items'
                    );
                }
            )
        )->where(
            'type',
            'page'
        )->get();

        return View::make(
            'core.pages.index',
            compact(
                'pages'
            )
        );
    }

    /**
     * @access public
     *
     * Get single page's sections list
     *
     * @param int $id of page primary id
     * @return Response HTML view of 'core.pages.sections' with array 'page'
     */
    public function page($id)
    {
        if (!$id) {

            return Redirect::to(
                '/core/error'
            )->with(
                'error',
                'Some thing is wrong, please contact to administrator!!'
            );
        }

        $page = core\CorePage::with(
            array(
                'sections' => function ($q) {
                    $q->with(
                        'items'
                    );
                }
            )
        )->where(
            'type',
            'page'
        )->where(
            'id',
            $id
        )->first();

        if (!$page) {

            return Redirect::to(
                '/core/error'
            )->with(
                'error',
                "Request can't be found, please contact to administrator!!"
            );
        }

        return View::make(
            'core.pages.sections',
            compact(
                'page'
            )
        );
    }

    /**
     * @access public
     *
     * @param int $pageId of page primary id
     * @param int $secId of section primary id
     * @param int $itemId of section item's primary id
     * @param string $contentType of content-type of the section
     * @return Response HTML view of 'core.pages.sections' with array 'page'
     */
    public function sectionItem(
        $pageId,
        $secId,
        $itemId,
        $contentType
    ) {
        if (!$pageId || !$secId || !$itemId || !$contentType) {

            return Redirect::to(
                '/core/error'
            )->with(
                'error',
                'Some thing is wrong, please contact to administrator!!'
            );
        }

        $itemInfo = core\CorePage::where(
            'id',
            $itemId
        )->where(
            'type',
            'item'
        )->orderBy(
            'id',
            'asc'
        )->first();

        if ($itemInfo) {
            switch ($contentType) {
                case 'slider':
                    $sliders = core\CoreSlider::where(
                        'item_id',
                        $itemInfo->id
                    )->get();

                    return View::make(
                        'core.contentType.sliders.index',
                        compact(
                            'pageId',
                            'secId',
                            'itemInfo',
                            'sliders'
                        )
                    );
                case 'post':
                    $post= core\CorePage::where(
                        'parent_id',
                        $itemInfo->id
                    )->where(
                        'type',
                        'content'
                    )->where(
                        'content_type',
                        'post'
                    )->first();

                    if (!$post) {
                        $post = new core\CorePage();
                    }

                    return View::make(
                        'core.contentType.posts.index',
                        compact(
                            'pageId',
                            'secId',
                            'itemInfo',
                            'post'
                        )
                    );
                case 'news':
                    $newses = core\CorePage::where(
                        'parent_id',
                        $itemInfo->id
                    )->where(
                        'type',
                        'content'
                    )->where(
                        'content_type',
                        'news'
                    )->orderBy(
                        'id',
                        'desc'
                    )->get();

                    return View::make(
                        'core.contentType.news.index',
                        compact(
                            'pageId',
                            'secId',
                            'itemInfo',
                            'newses'
                        )
                    );
                case 'gallery':
                    $images = core\CorePage::where(
                        'parent_id',
                        $itemInfo->id
                    )->where(
                        'type',
                        'content'
                    )->where(
                        'content_type',
                        'gallery'
                    )->get();

                    return View::make(
                        'core.contentType.gallery.index',
                        compact(
                            'pageId',
                            'secId',
                            'itemInfo',
                            'images'
                        )
                    );
                case 'profile':
                    $profiles = core\CorePage::where(
                        'parent_id',
                        $itemInfo->id
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

                    return View::make(
                        'core.contentType.profileGallery.index',
                        compact(
                            'pageId',
                            'secId',
                            'itemInfo',
                            'profiles'
                        )
                    );
                case 'banner':
                    $bn= core\CorePage::where(
                        'parent_id',
                        $itemInfo->id
                    )->where(
                        'type',
                        'content'
                    )->where(
                        'content_type',
                        'banner'
                    )->first();

                    if (!$bn) {
                        $bn = new core\CorePage();
                    }

                    return View::make(
                        'core.contentType.banner.index',
                        compact(
                            'pageId',
                            'secId',
                            'itemInfo',
                            'bn'
                        )
                    );
                case 'cForm':
                    $cForm= core\CorePage::where(
                        'parent_id',
                        $itemInfo->id
                    )->where(
                        'type',
                        'content'
                    )->where(
                        'content_type',
                        'cForm'
                    )->first();

                    if (!$cForm) {
                        $cForm = new core\CorePage();
                    }

                    return View::make(
                        'core.contentType.cform.index',
                        compact(
                            'pageId',
                            'secId',
                            'itemInfo',
                            'cForm'
                        )
                    );
                default:
                    return Redirect::to(
                        '/core/error'
                    )->with(
                        'error',
                        'Some thing is wrong, please contact to administrator!!'
                    );

            }
        }

        return Redirect::to(
            '/core/error'
        )->with(
            'error',
            'Some thing is wrong, please contact to administrator!!'
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

    /**
     * @access public
     *
     * Update the selection properties
     *
     * @param int $secId of section primary id
     * @param string $part of 'core_pages' table's field name
     * @return Response JSON Data
     */
    public function secUpdate($secId, $part)
    {
        if (!$secId || !$part) {

            return Response::Json(
                array(
                    'status' => 'error',
                    'msg' => 'Some thing is wrong, please contact to administrator!!'
                )
            );
        }

        $sec = core\CorePage::where(
            'id',
            $secId
        )->first();

        if (!$sec) {

            return Response::Json(
                array(
                    'status' => 'error',
                    'msg' => 'Some thing is wrong, please contact to administrator!!'
                )
            );
        }

        if ($part == 'sectionorder') {
            $part = 'section_order';
        }

        if (($data = trim(Input::get('value'))) == null) {

            return Response::Json(
                array(
                    'status' => 'error',
                    'msg' => 'Some thing is wrong, please contact to administrator!!'
                )
            );
        }

        $query = $sec->update(
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

}
