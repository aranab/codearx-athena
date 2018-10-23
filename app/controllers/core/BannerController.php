<?php
namespace app\controllers\core;

use app\controllers\base;
use app\models\core;
use View;
use Input;
use Redirect;
use Validator;
use Response;
use Auth;
use File;

/**
 * Class BannerController
 *
 * @extends base\CoreController
 * @package app\controllers\core
 */
class BannerController extends base\CoreController
{
    /**
     * @access public
     *
     * 'GET' form for creating new banner image
     *
     * @param int $pageId of page primary id
     * @param int $secId of section primary id
     * @param int $itemId of section item's primary id
     * @return Response HTML view of 'core.contentType.sliders.create'
     */
    public function create($pageId, $secId, $itemId)
    {
        if (!$pageId || !$secId || !$itemId) {

            return Redirect::to(
                '/core/error'
            )->with(
                'error',
                'Some thing is wrong, please contact to administrator!!'
            );
        }

        return View::make(
            'core.contentType.banner.create',
            compact(
                'pageId',
                'secId',
                'itemId'
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
     * Data are being stored inside database table 'core_pages'
     *
     * @return Redirect to action 'PagesController@sectionItem' with flash message
     */
    public function store()
    {
        $data = Input::all();

        $rules = array(
            'pic' => 'required|max:1600|mimes:jpeg,png',
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

        if( !($pageId = trim(Input::get('pageId'))) ||
            !($secId = trim(Input::get('secId')))   ||
            !($itemId = trim(Input::get('itemId')))) {

            Redirect::to(
                "/core/error"
            )->with(
                'error',
                'Some problem arise for refreshing the page. Please try again!!'
            );
        }

        $title = trim(Input::get('title')); // Title
        $tTag = trim(Input::get('tTag')); // Title html tag
        $tfs = trim(Input::get('tfs')); // Title font size
        $tfc = trim(Input::get('tfc')); // Title font color

        $des = trim(Input::get('des')); // Description
        $dTag = trim(Input::get('dTag')); // Description html tag
        $dfs = trim(Input::get('dfs')); // Description font size
        $dfc = trim(Input::get('dfc')); // Description font color

        $pb = trim(Input::get('pb')); // Content Position bottom
        $pl = trim(Input::get('pl')); // Content Position left
        $pr = trim(Input::get('pr')); // Content Position right
        $ta = trim(Input::get('ta')); // Text Align
        $pic = Input::file('pic');

        $bn= new core\CorePage();
        $bn->title = $title;
        $bn->parent_id = $itemId;
        $bn->name = preg_replace('/\s+/', '-', $bn->title);
        $bn->content = json_encode(
            [
                'cls' => '',
                'tTag'=> $tTag == null? 'h1' : $tTag,
                'tfs' => $tfs == null? '' : $tfs.'px',
                'tfc' => $tfc == null? '#ffffff' : $tfc,
                'des' => $des == null? '' : $des,
                'dTag'=> $dTag == null? 'h1' : $dTag,
                'dfs' => $dfs == null? '' : $dfs.'px',
                'dfc' => $dfc == null? '#ffffff' : $dfc,
                'pb'  => $pb == null? '0%' : $pb,
                'pl'  => $pl == null? '0%' : $pl,
                'pr'  => $pr == null? '0%' : $pr,
                'ta'  => $ta == null? 'left' : $ta,
            ]
        );
        $bn->type = 'content';
        $bn->content_type = 'banner';
        $bn->status = true;
        $bn->mime_type = $pic->getMimeType();
        $bn->guid = '';
        $bn->uploaded_by = Auth::user()->username;
        $bn->uploaded_date = date('Y-m-d H:i:s');
        $bn->modified_by = Auth::user()->username;
        $bn->modified_date = date('Y-m-d H:i:s');

        try {
            $bn->save();
        } catch (\Exception $e) {

            return Redirect::back()->with(
                'error',
                $e->getMessage()
            );
        }

        $bn->update(
            array(
                'guid' => '/upload/gallery/'.$bn->id.'.'.$pic->guessClientExtension()
            )
        );

        $destinationPath = public_path().'/upload/gallery/';
        $picName = $bn->id.'.'.$pic->guessClientExtension();
        $pic->move(
            $destinationPath,
            $picName
        );

        return Redirect::to(
            "/core/pages/$pageId/$secId/$itemId/banner"
        )->with(
            'success',
            'Congratulation!!, banner image has been created successfully!!'
        );
    }

    /**
     * @access public
     *
     * 'GET' details of selected slider
     *
     * @param int $pageId of page primary id
     * @param int $secId of section primary id
     * @param int $itemId of section item's primary id
     * @param int $bId of banner primary id
     * @return Response HTML view of 'core.contentType.banner.details' with array data of 'pageId', 'secId', 'banner'
     */
    public function details($pageId, $secId, $itemId, $bId)
    {
        if (!$pageId || !$secId || !$itemId || !$bId) {

            return Redirect::to(
                '/core/error'
            )->with(
                'error',
                'Some thing is wrong, please contact to administrator!!'
            );
        }

        $banner = core\CorePage::where(
            'id',
            $bId
        )->where(
            'type',
            'content'
        )->where(
            'content_type',
            'banner'
        )->first();

        return View::make(
            'core.contentType.banner.details',
            compact(
                'pageId',
                'secId',
                'itemId',
                'banner'
            )
        );
    }

    /**
     * @access public
     *
     *
     * @param int $bId of banner primary id
     * @param string $part of 'core_pages' table's field name
     * @return Response JSON Data
     */
    public function update($bId, $part)
    {
        if (!$bId || !$part) {

            return Response::Json(
                array(
                    'status' => 'error',
                    'msg' => 'Some thing is wrong, please contact to administrator!!'
                )
            );
        }

        $bn = core\CorePage::where(
            'id',
            $bId
        )->where(
            'type',
            'content'
        )->where(
            'content_type',
            'banner'
        )->first();

        if (!$bn) {

            return Response::Json(
                array(
                    'status' => 'error',
                    'msg' => 'Some thing is wrong, please contact to administrator!!'
                )
            );
        }

        if ($part == 'ext' && Input::hasFile('pic')) {

            $pic = Input::file('pic');
            File::Delete(public_path().$bn->guid);
            $query = $bn->update(
                array(
                    'mime_type' => $pic->getMimeType(),
                    'guid' => '/upload/gallery/'.$bn->id.'.'.$pic->guessClientExtension(),
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

            $destinationPath = public_path().'/upload/gallery/';
            $picName = $bn->id.'.'.$pic->guessClientExtension();
            $pic->move(
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

        $data = trim(Input::get('value'));

        if ($part == 'title') {
            $query = $bn->update(
                array(
                    'title' => $data,
                    'name' => preg_replace('/\s+/', '-', $data),
                    'modified_by' => Auth::user()->username,
                    'modified_date' => date('Y-m-d H:i:s')
                )
            );
        } else {
            $query = $bn->update(
                array(
                    $part => $data,
                    'modified_by' => Auth::user()->username,
                    'modified_date' => date('Y-m-d H:i:s')
                )
            );
        }

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
     * Update the banner content JSON data
     *
     * @param int $bId of banner primary id
     * @param string $part of 'core_pages' table's field name 'content' JSON data
     * @return Response JSON Data
     */
    public function contentUpdate($bId, $part)
    {
        if (!$bId || !$part) {

            return Response::Json(
                array(
                    'status' => 'error',
                    'msg' => 'Some thing is wrong, please contact to administrator!!'
                )
            );
        }

        $bn = core\CorePage::where(
            'id',
            $bId
        )->where(
            'type',
            'content'
        )->where(
            'content_type',
            'banner'
        )->first();


        if (!$bn) {

            return Response::Json(
                array(
                    'status' => 'error',
                    'msg' => 'Some thing is wrong, please contact to administrator!!'
                )
            );
        }

        $arr = json_decode($bn->content, true);
        $data = trim(Input::get('value'));

        if ($part == 'cls') {
            $arr = json_encode(
                [
                    'cls' => $data == null? '' : $data,
                    'tTag'=> $arr['tTag'],
                    'tfs' => $arr['tfs'],
                    'tfc' => $arr['tfc'],
                    'des' => $arr['des'],
                    'dTag'=> $arr['dTag'],
                    'dfs' => $arr['dfs'],
                    'dfc' => $arr['dfc'],
                    'pb'  => $arr['pb'],
                    'pl'  => $arr['pl'],
                    'pr'  => $arr['pr'],
                    'ta'  => $arr['ta']
                ]
            );
        }

        if ($part == 'tTag') {
            $arr = json_encode(
                [
                    'cls' => $arr['cls'],
                    'tTag'=> $data == null? 'h1' : $data,
                    'tfs' => $arr['tfs'],
                    'tfc' => $arr['tfc'],
                    'des' => $arr['des'],
                    'dTag'=> $arr['dTag'],
                    'dfs' => $arr['dfs'],
                    'dfc' => $arr['dfc'],
                    'pb'  => $arr['pb'],
                    'pl'  => $arr['pl'],
                    'pr'  => $arr['pr'],
                    'ta'  => $arr['ta']
                ]
            );
        }

        if ($part == 'tfs') {
            $arr = json_encode(
                [
                    'cls' => $arr['cls'],
                    'tTag'=> $arr['tTag'],
                    'tfs' => $data == null? '' : $data,
                    'tfc' => $arr['tfc'],
                    'des' => $arr['des'],
                    'dTag'=> $arr['dTag'],
                    'dfs' => $arr['dfs'],
                    'dfc' => $arr['dfc'],
                    'pb'  => $arr['pb'],
                    'pl'  => $arr['pl'],
                    'pr'  => $arr['pr'],
                    'ta'  => $arr['ta']
                ]
            );
        }

        if ($part == 'tfc') {
            $arr = json_encode(
                [
                    'cls' => $arr['cls'],
                    'tTag'=> $arr['tTag'],
                    'tfs' => $arr['tfs'],
                    'tfc' => $data == null? '#ffffff' : $data,
                    'des' => $arr['des'],
                    'dTag'=> $arr['dTag'],
                    'dfs' => $arr['dfs'],
                    'dfc' => $arr['dfc'],
                    'pb'  => $arr['pb'],
                    'pl'  => $arr['pl'],
                    'pr'  => $arr['pr'],
                    'ta'  => $arr['ta']
                ]
            );
        }

        if ($part == 'des') {
            $arr = json_encode(
                [
                    'cls' => $arr['cls'],
                    'tTag'=> $arr['tTag'],
                    'tfs' => $arr['tfs'],
                    'tfc' => $arr['tfc'],
                    'des' => $data == null? '' : $data,
                    'dTag'=> $arr['dTag'],
                    'dfs' => $arr['dfs'],
                    'dfc' => $arr['dfc'],
                    'pb'  => $arr['pb'],
                    'pl'  => $arr['pl'],
                    'pr'  => $arr['pr'],
                    'ta'  => $arr['ta']
                ]
            );
        }

        if ($part == 'dTag') {
            $arr = json_encode(
                [
                    'cls' => $arr['cls'],
                    'tTag'=> $arr['tTag'],
                    'tfs' => $arr['tfs'],
                    'tfc' => $arr['tfc'],
                    'des' => $arr['des'],
                    'dTag'=> $data == null? 'h1' : $data,
                    'dfs' => $arr['dfs'],
                    'dfc' => $arr['dfc'],
                    'pb'  => $arr['pb'],
                    'pl'  => $arr['pl'],
                    'pr'  => $arr['pr'],
                    'ta'  => $arr['ta']
                ]
            );
        }

        if ($part == 'dfs') {
            $arr = json_encode(
                [
                    'cls' => $arr['cls'],
                    'tTag'=> $arr['tTag'],
                    'tfs' => $arr['tfs'],
                    'tfc' => $arr['tfc'],
                    'des' => $arr['des'],
                    'dTag'=> $arr['dTag'],
                    'dfs' => $data == null? '' : $data,
                    'dfc' => $arr['dfc'],
                    'pb'  => $arr['pb'],
                    'pl'  => $arr['pl'],
                    'pr'  => $arr['pr'],
                    'ta'  => $arr['ta']
                ]
            );
        }

        if ($part == 'dfc') {
            $arr = json_encode(
                [
                    'cls' => $arr['cls'],
                    'tTag'=> $arr['tTag'],
                    'tfs' => $arr['tfs'],
                    'tfc' => $arr['tfc'],
                    'des' => $arr['des'],
                    'dTag'=> $arr['dTag'],
                    'dfs' => $arr['dfs'],
                    'dfc' => $data == null? '#ffffff' : $data,
                    'pb'  => $arr['pb'],
                    'pl'  => $arr['pl'],
                    'pr'  => $arr['pr'],
                    'ta'  => $arr['ta']
                ]
            );
        }

        if ($part == 'pb') {
            $arr = json_encode(
                [
                    'cls' => $arr['cls'],
                    'tTag'=> $arr['tTag'],
                    'tfs' => $arr['tfs'],
                    'tfc' => $arr['tfc'],
                    'des' => $arr['des'],
                    'dTag'=> $arr['dTag'],
                    'dfs' => $arr['dfs'],
                    'dfc' => $arr['dfc'],
                    'pb'  => $data == null? '0%' : $data,
                    'pl'  => $arr['pl'],
                    'pr'  => $arr['pr'],
                    'ta'  => $arr['ta']
                ]
            );
        }

        if ($part == 'pl') {
            $arr = json_encode(
                [
                    'cls' => $arr['cls'],
                    'tTag'=> $arr['tTag'],
                    'tfs' => $arr['tfs'],
                    'tfc' => $arr['tfc'],
                    'des' => $arr['des'],
                    'dTag'=> $arr['dTag'],
                    'dfs' => $arr['dfs'],
                    'dfc' => $arr['dfc'],
                    'pb'  => $arr['pb'],
                    'pl'  => $data == null? '0%' : $data,
                    'pr'  => $arr['pr'],
                    'ta'  => $arr['ta']
                ]
            );
        }

        if ($part == 'pr') {
            $arr = json_encode(
                [
                    'cls' => $arr['cls'],
                    'tTag'=> $arr['tTag'],
                    'tfs' => $arr['tfs'],
                    'tfc' => $arr['tfc'],
                    'des' => $arr['des'],
                    'dTag'=> $arr['dTag'],
                    'dfs' => $arr['dfs'],
                    'dfc' => $arr['dfc'],
                    'pb'  => $arr['pb'],
                    'pl'  => $arr['pl'],
                    'pr'  => $data == null? '0%' : $data,
                    'ta'  => $arr['ta']
                ]
            );
        }

        if ($part == 'ta') {
            $arr = json_encode(
                [
                    'cls' => $arr['cls'],
                    'tTag'=> $arr['tTag'],
                    'tfs' => $arr['tfs'],
                    'tfc' => $arr['tfc'],
                    'des' => $arr['des'],
                    'dTag'=> $arr['dTag'],
                    'dfs' => $arr['dfs'],
                    'dfc' => $arr['dfc'],
                    'pb'  => $arr['pb'],
                    'pl'  => $arr['pl'],
                    'pr'  => $arr['pr'],
                    'ta'  => $data == null? 'left' : $data,
                ]
            );
        }

        $query = $bn->update(
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
