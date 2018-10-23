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
 * Class GalleryController
 *
 * @extends base\CoreController
 * @package app\controllers\core
 */
class GalleryController extends base\CoreController
{
    /**
     * @access public
     *
     * 'GET' form for creating new image for gallery
     *
     * @param int $pageId of page primary id
     * @param int $secId of section primary id
     * @param int $itemId of section item's primary id
     * @return Response HTML view of 'core.contentType.gallery.create'
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
            'core.contentType.gallery.create',
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
            'des' => 'max:100',
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

        $title = trim(Input::get('title'));
        $des = trim(Input::get('des'));

        $ict = trim(Input::get('ict')); //  Is Circle Thumbnail
        $fc = trim(Input::get('fColor')); // Font Color
        $ta = trim(Input::get('ta')); // Text Align
        $pic = Input::file('pic');

        $gallery = new core\CorePage();
        $gallery->title = $title;
        $gallery->parent_id = $itemId;
        $gallery->name = preg_replace('/\s+/', '-', $gallery->title);
        $gallery->content = json_encode(
            [
                'des' => $des == null? '' : $des,
                'ict' => $ict,
                'fc' => $fc == null? '#ffffff' : $fc,
                'ta' => $ta == null? 'left' : $ta
            ]
        );
        $gallery->type = 'content';
        $gallery->content_type = 'gallery';
        $gallery->status = true;
        $gallery->mime_type = $pic->getMimeType();
        $gallery->guid = '';
        $gallery->uploaded_by = Auth::user()->username;
        $gallery->uploaded_date = date('Y-m-d H:i:s');
        $gallery->modified_by = Auth::user()->username;
        $gallery->modified_date = date('Y-m-d H:i:s');

        try {
            $gallery->save();
        } catch (\Exception $e) {

            return Redirect::back()->with(
                'error',
                $e->getMessage()
            );
        }

        $gallery->update(
            array(
                'guid' => '/upload/gallery/'.$gallery->id.'.'.$pic->guessClientExtension()
            )
        );

        $destinationPath = public_path().'/upload/gallery/';
        $picName = $gallery->id.'.'.$pic->guessClientExtension();
        $pic->move(
            $destinationPath,
            $picName
        );

        return Redirect::to(
            "/core/pages/$pageId/$secId/$itemId/gallery"
        )->with(
            'success',
            'Congratulation!!, "'.$gallery->title.'" gallery image has been created successfully!!'
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
     * @param int $gId of gallery primary id
     * @return Response HTML view of 'core.contentType.gallery.details' with array data of 'pageId', 'secId', 'itemId',
     * 'image'
     */
    public function details($pageId, $secId, $itemId, $gId)
    {
        if (!$pageId || !$secId || !$itemId || !$gId) {

            return Redirect::to(
                '/core/error'
            )->with(
                'error',
                'Some thing is wrong, please contact to administrator!!'
            );
        }

        $image = core\CorePage::where(
            'id',
            $gId
        )->first();

        return View::make(
            'core.contentType.gallery.details',
            compact(
                'pageId',
                'secId',
                'itemId',
                'image'
            )
        );
    }

    /**
     * @access public
     *
     * Updated the 'core_pages' table's field
     *
     * @param int $gId of gallery primary id
     * @param string $part of 'core_pages' table's field name
     * @return Response JSON Data
     */
    public function update($gId, $part)
    {
        if (!$gId || !$part) {

            return Response::Json(
                array(
                    'status' => 'error',
                    'msg' => 'Some thing is wrong, please contact to administrator!!'
                )
            );
        }

        $img = core\CorePage::where(
            'id',
            $gId
        )->first();

        if (!$img) {

            return Response::Json(
                array(
                    'status' => 'error',
                    'msg' => 'Some thing is wrong, please contact to administrator!!'
                )
            );
        }

        if ($part == 'ext' && Input::hasFile('pic')) {

            $pic = Input::file('pic');
            File::Delete(public_path().$img->guid);
            $query = $img->update(
                array(
                        'mime_type' => $pic->getMimeType(),
                        'guid' => '/upload/gallery/'.$img->id.'.'.$pic->guessClientExtension(),
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
            $picName = $img->id.'.'.$pic->guessClientExtension();
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

        $query = $img->update(
            array(
                'title' => $data,
                'name' => preg_replace('/\s+/', '-', $data),
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
     * Update the gallery content JSON data
     *
     * @param int $gId of gallery primary id
     * @param string $part of 'core_pages' table's field name 'content' JSON data
     * @return Response JSON Data
     */
    public function contentUpdate($gId, $part)
    {
        if (!$gId || !$part) {

            return Response::Json(
                array(
                    'status' => 'error',
                    'msg' => 'Some thing is wrong, please contact to administrator!!'
                )
            );
        }

        $img = core\CorePage::where(
            'id',
            $gId
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

        if ($part == 'des') {
            $arr = json_encode(
                [
                    'des' => $data == null? '' : $data,
                    'ict' => $arr['ict'],
                    'fc' => $arr['fc'],
                    'ta' => $arr['ta']
                ]
            );
        }

        if ($part == 'ict') {
            $arr = json_encode(
                [
                    'des' => $arr['des'],
                    'ict' => $data == null? false : $data,
                    'fc' => $arr['fc'],
                    'ta' => $arr['ta']
                ]
            );
        }

        if ($part == 'fc') {
            $arr = json_encode(
                [
                    'des' => $arr['des'],
                    'ict' => $arr['ict'],
                    'fc' => $data == null? '#ffffff' : $data,
                    'ta' => $arr['ta']
                ]
            );

        }

        if ($part == 'ta') {
            $arr = json_encode(
                [
                    'des' => $arr['des'],
                    'ict' => $arr['ict'],
                    'fc' => $arr['fc'],
                    'ta' => $data == null? 'left' : $data
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
