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
 * Class ProfileGalleryController
 *
 * @extends base\CoreController
 * @package app\controllers\core
 */
class ProfileGalleryController extends base\CoreController
{
    /**
     * @access public
     *
     * 'GET' form for creating new image for gallery
     *
     * @param int $pageId of page primary id
     * @param int $secId of section primary id
     * @param int $itemId of section item's primary id
     * @return Response HTML view of 'core.contentType.profileGallery.create'
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
            'core.contentType.profileGallery.create',
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
            'title' => 'required|max:50',
            'sDes' => 'max:100',
            'order' => 'required',
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
        $ttc = trim(Input::get('ttc')); // Title font color
        $tts = trim(Input::get('tts')); // Title font size

        $sDes = trim(Input::get('sDes')); // Short description
        $stc = trim(Input::get('stc')); // Short description font color
        $sts = trim(Input::get('sts')); // Short description font size

        $lDes = trim(Input::get('lDes')); // Long description
        $ltc = trim(Input::get('ltc')); // Long description font color
        $lts = trim(Input::get('lts')); // Long description font size

        $ilp = trim(Input::get('ilp')); //  Is Linkable Profile
        $ict = trim(Input::get('ict')); //  Is Circle Thumbnail
        $ta = trim(Input::get('ta')); // Text Align
        $cls = trim(Input::get('cls')); // Image css class
        $pic = Input::file('pic');

        $prf= new core\CorePage();
        $prf->title = $title;
        $prf->parent_id = $itemId;
        $prf->name = preg_replace('/\s+/', '-', $prf->title);
        $prf->content = json_encode(
            [
                'cls' => $cls == null? '' : $cls,
                'ttc' => $ttc == null? '#ffffff' : $ttc,
                'tts' => $tts == null? '12px' : $tts.'px',
                'sDes'=> $sDes == null? '' : $sDes,
                'stc' => $stc == null? '#ffffff' : $ttc,
                'sts' => $sts == null? '12px' : $tts.'px',
                'lDes'=> $lDes == null? '' : $lDes,
                'ltc' => $stc == null? '#ffffff' : $ltc,
                'lts' => $sts == null? '12px' : $lts.'px',
                'ilp' => $ilp == null? false : $ilp,
                'ict' => $ict == null? false : $ict,
                'ta'  => $ta == null? 'left' : $ta
            ]
        );
        $prf->type = 'content';
        $prf->content_type = 'profile';
        $prf->status = true;
        $prf->section_order = trim(Input::get('order'));
        $prf->mime_type = $pic->getMimeType();
        $prf->guid = '';
        $prf->uploaded_by = Auth::user()->username;
        $prf->uploaded_date = date('Y-m-d H:i:s');
        $prf->modified_by = Auth::user()->username;
        $prf->modified_date = date('Y-m-d H:i:s');

        try {
            $prf->save();
        } catch (\Exception $e) {

            return Redirect::back()->with(
                'error',
                $e->getMessage()
            );
        }

        $prf->update(
            array(
                'guid' => '/upload/gallery/'.$prf->id.'.'.$pic->guessClientExtension()
            )
        );

        $destinationPath = public_path().'/upload/gallery/';
        $picName = $prf->id.'.'.$pic->guessClientExtension();
        $pic->move(
            $destinationPath,
            $picName
        );

        return Redirect::to(
            "/core/pages/$pageId/$secId/$itemId/profile"
        )->with(
            'success',
            'Congratulation!!, "'.$prf->title.'" profile image has been created successfully!!'
        );
    }

    /**
     * @access public
     *
     * 'GET' details of selected image
     *
     * @param int $pageId of page primary id
     * @param int $secId of section primary id
     * @param int $itemId of section item's primary id
     * @param int $pId of profile primary id
     * @return Response HTML view of 'core.contentType.profileGallery.details' with array data of 'pageId', 'secId',
     * 'itemId', 'prf'
     */
    public function details($pageId, $secId, $itemId, $pId)
    {
        if (!$pageId || !$secId || !$itemId || !$pId) {

            return Redirect::to(
                '/core/error'
            )->with(
                'error',
                'Some thing is wrong, please contact to administrator!!'
            );
        }

        $prf = core\CorePage::where(
            'id',
            $pId
        )->first();

        return View::make(
            'core.contentType.profileGallery.details',
            compact(
                'pageId',
                'secId',
                'itemId',
                'prf'
            )
        );
    }

    /**
     * @access public
     *
     * Updated the 'core_pages' table's field
     *
     * @param int $pId of profile primary id
     * @param string $part of 'core_pages' table's field name
     * @return Response JSON Data
     */
    public function update($pId, $part)
    {
        if (!$pId || !$part) {

            return Response::Json(
                array(
                    'status' => 'error',
                    'msg' => 'Some thing is wrong, please contact to administrator!!'
                )
            );
        }

        $prf = core\CorePage::where(
            'id',
            $pId
        )->first();

        if (!$prf) {

            return Response::Json(
                array(
                    'status' => 'error',
                    'msg' => 'Some thing is wrong, please contact to administrator!!'
                )
            );
        }

        if ($part == 'ext' && Input::hasFile('pic')) {

            $pic = Input::file('pic');
            File::Delete(public_path().$prf->guid);
            $query = $prf->update(
                array(
                    'mime_type' => $pic->getMimeType(),
                    'guid' => '/upload/gallery/'.$prf->id.'.'.$pic->guessClientExtension(),
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
            $picName = $prf->id.'.'.$pic->guessClientExtension();
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

        if (($data = trim(Input::get('value'))) == null) {

            return Response::Json(
                array(
                    'status' => 'error',
                    'msg' => 'Some thing is wrong, please contact to administrator!!'
                )
            );
        }

        if ($part == 'order') {
            $part = 'section_order';
        }

        if ($part == 'title') {
            $query = $prf->update(
                array(
                    'title' => $data,
                    'name' => preg_replace('/\s+/', '-', $data),
                    'modified_by' => Auth::user()->username,
                    'modified_date' => date('Y-m-d H:i:s')
                )
            );
        } else {
            $query = $prf->update(
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
     * Update the gallery content JSON data
     *
     * @param int $pId of profile primary id
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

        $img = core\CorePage::where(
            'id',
            $pId
        )->first();

        if (!$img) {

            return Response::Json(
                array(
                    'status' => 'error',
                    'msg' => 'Some thing is wrong, please contact to administrator!!'
                )
            );
        }

        $arr = json_decode($img->content, true);
        $data = trim(Input::get('value'));

        if ($part == 'cls') {
            $arr = json_encode(
                [
                    'cls' => $data == null? '' : $data,
                    'ttc' => $arr['ttc'],
                    'tts' => $arr['tts'],
                    'sDes'=> $arr['sDes'],
                    'stc' => $arr['stc'],
                    'sts' => $arr['sts'],
                    'lDes'=> $arr['lDes'],
                    'ltc' => $arr['ltc'],
                    'lts' => $arr['lts'],
                    'ilp' => $arr['ilp'],
                    'ict' => $arr['ict'],
                    'ta'  => $arr['ta']
                ]
            );
        }

        if ($part == 'ttc') {
            $arr = json_encode(
                [
                    'cls' => $arr['cls'],
                    'ttc' => $data == null? '#ffffff' : $data,
                    'tts' => $arr['tts'],
                    'sDes'=> $arr['sDes'],
                    'stc' => $arr['stc'],
                    'sts' => $arr['sts'],
                    'lDes'=> $arr['lDes'],
                    'ltc' => $arr['ltc'],
                    'lts' => $arr['lts'],
                    'ilp' => $arr['ilp'],
                    'ict' => $arr['ict'],
                    'ta'  => $arr['ta']
                ]
            );
        }

        if ($part == 'tts') {
            $arr = json_encode(
                [
                    'cls' => $arr['cls'],
                    'ttc' => $arr['ttc'],
                    'tts' => $data == null? '12' : $data,
                    'sDes'=> $arr['sDes'],
                    'stc' => $arr['stc'],
                    'sts' => $arr['sts'],
                    'lDes'=> $arr['lDes'],
                    'ltc' => $arr['ltc'],
                    'lts' => $arr['lts'],
                    'ilp' => $arr['ilp'],
                    'ict' => $arr['ict'],
                    'ta'  => $arr['ta']
                ]
            );
        }

        if ($part == 'sDes') {
            $arr = json_encode(
                [
                    'cls' => $arr['cls'],
                    'ttc' => $arr['ttc'],
                    'tts' => $arr['tts'],
                    'sDes'=> $data == null? '' : $data,
                    'stc' => $arr['stc'],
                    'sts' => $arr['sts'],
                    'lDes'=> $arr['lDes'],
                    'ltc' => $arr['ltc'],
                    'lts' => $arr['lts'],
                    'ilp' => $arr['ilp'],
                    'ict' => $arr['ict'],
                    'ta'  => $arr['ta']
                ]
            );
        }

        if ($part == 'stc') {
            $arr = json_encode(
                [
                    'cls' => $arr['cls'],
                    'ttc' => $arr['ttc'],
                    'tts' => $arr['tts'],
                    'sDes'=> $arr['sDes'],
                    'stc' => $data == null? '#ffffff' : $data,
                    'sts' => $arr['sts'],
                    'lDes'=> $arr['lDes'],
                    'ltc' => $arr['ltc'],
                    'lts' => $arr['lts'],
                    'ilp' => $arr['ilp'],
                    'ict' => $arr['ict'],
                    'ta'  => $arr['ta']
                ]
            );
        }

        if ($part == 'sts') {
            $arr = json_encode(
                [
                    'cls' => $arr['cls'],
                    'ttc' => $arr['ttc'],
                    'tts' => $arr['tts'],
                    'sDes'=> $arr['sDes'],
                    'stc' => $arr['stc'],
                    'sts' => $data == null? '12' : $data,
                    'lDes'=> $arr['lDes'],
                    'ltc' => $arr['ltc'],
                    'lts' => $arr['lts'],
                    'ilp' => $arr['ilp'],
                    'ict' => $arr['ict'],
                    'ta'  => $arr['ta']
                ]
            );
        }

        if ($part == 'lDes') {
            $arr = json_encode(
                [
                    'cls' => $arr['cls'],
                    'ttc' => $arr['ttc'],
                    'tts' => $arr['tts'],
                    'sDes'=> $arr['sDes'],
                    'stc' => $arr['stc'],
                    'sts' => $arr['sts'],
                    'lDes'=> $data == null? '' : $data,
                    'ltc' => $arr['ltc'],
                    'lts' => $arr['lts'],
                    'ilp' => $arr['ilp'],
                    'ict' => $arr['ict'],
                    'ta'  => $arr['ta']
                ]
            );
        }

        if ($part == 'ltc') {
            $arr = json_encode(
                [
                    'cls' => $arr['cls'],
                    'ttc' => $arr['ttc'],
                    'tts' => $arr['tts'],
                    'sDes'=> $arr['sDes'],
                    'stc' => $arr['stc'],
                    'sts' => $arr['sts'],
                    'lDes'=> $arr['lDes'],
                    'ltc' => $data == null? '#ffffff' : $data,
                    'lts' => $arr['lts'],
                    'ilp' => $arr['ilp'],
                    'ict' => $arr['ict'],
                    'ta'  => $arr['ta']
                ]
            );
        }

        if ($part == 'lts') {
            $arr = json_encode(
                [
                    'cls' => $arr['cls'],
                    'ttc' => $arr['ttc'],
                    'tts' => $arr['tts'],
                    'sDes'=> $arr['sDes'],
                    'stc' => $arr['stc'],
                    'sts' => $arr['sts'],
                    'lDes'=> $arr['lDes'],
                    'ltc' => $arr['ltc'],
                    'lts' => $data == null? '12' : $data,
                    'ilp' => $arr['ilp'],
                    'ict' => $arr['ict'],
                    'ta'  => $arr['ta']
                ]
            );
        }

        if ($part == 'ilp') {
            $arr = json_encode(
                [
                    'cls' => $arr['cls'],
                    'ttc' => $arr['ttc'],
                    'tts' => $arr['tts'],
                    'sDes'=> $arr['sDes'],
                    'stc' => $arr['stc'],
                    'sts' => $arr['sts'],
                    'lDes'=> $arr['lDes'],
                    'ltc' => $arr['ltc'],
                    'lts' => $arr['lts'],
                    'ilp' => $data == null? false : $data,
                    'ict' => $arr['ict'],
                    'ta'  => $arr['ta']
                ]
            );
        }

        if ($part == 'ict') {
            $arr = json_encode(
                [
                    'cls' => $arr['cls'],
                    'ttc' => $arr['ttc'],
                    'tts' => $arr['tts'],
                    'sDes'=> $arr['sDes'],
                    'stc' => $arr['stc'],
                    'sts' => $arr['sts'],
                    'lDes'=> $arr['lDes'],
                    'ltc' => $arr['ltc'],
                    'lts' => $arr['lts'],
                    'ilp' => $arr['ilp'],
                    'ict' => $data == null? false : $data,
                    'ta'  => $arr['ta']
                ]
            );
        }

        if ($part == 'ta') {
            $arr = json_encode(
                [
                    'cls' => $arr['cls'],
                    'ttc' => $arr['ttc'],
                    'tts' => $arr['tts'],
                    'sDes'=> $arr['sDes'],
                    'stc' => $arr['stc'],
                    'sts' => $arr['sts'],
                    'lDes'=> $arr['lDes'],
                    'ltc' => $arr['ltc'],
                    'lts' => $arr['lts'],
                    'ilp' => $arr['ilp'],
                    'ict' => $arr['ict'],
                    'ta'  => $data == null? 'left' : $data,
                ]
            );
        }

        $query = $img->update(
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
