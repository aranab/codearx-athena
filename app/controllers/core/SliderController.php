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
 * Class SliderController
 *
 * @extends base\CoreController
 * @package app\controllers\core
 */
class SliderController extends base\CoreController
{
    /**
     * @access public
     *
     * 'GET' form for creating new slider image
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
            'core.contentType.sliders.create',
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
     * Data are being stored inside database table 'core_sliders'
     *
     * @return Redirect to action 'PagesController@sectionItem' with flash message
     */
    public function store()
    {
        $data = Input::all();

        $rules = array(
            'name' => 'required|max:50',
            'order' => 'required',
            'title' => 'max:50',
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

        $name = trim(Input::get('name'));
        $order = trim(Input::get('order'));

        $pb = trim(Input::get('pb'));
        $pl = trim(Input::get('pl'));
        $pr = trim(Input::get('pr'));
        $tc = trim(Input::get('tc'));
        $dc = trim(Input::get('dc'));

        $slider = new core\CoreSlider();
        $slider->item_id = $itemId;
        $slider->name = $name;
        $slider->title = trim(Input::get('title'));
        $slider->description = Input::get('description');
        $slider->content = json_encode(
            [
                'pb' => $pb == null? '0%' : $pb,
                'pl' => $pl == null? '0%' : $pl,
                'pr' => $pr == null? '0%' : $pr,
                'tc' => $tc == null? '#ffffff' : $tc,
                'dc'=> $dc == null? '#ffffff' : $dc
            ]
        );
        $slider->pic_name = preg_replace('/\s+/', '_', strtolower($name));
        $slider->path = '/upload/slider/';
        $slider->order_no = $order;
        $slider->status = true;
        $slider->uploaded_by = Auth::user()->username;
        $slider->uploaded_date = date('Y-m-d H:i:s');
        $slider->modified_by = Auth::user()->username;
        $slider->modified_date = date('Y-m-d H:i:s');

        $extension = null;
        if (Input::hasFile('pic')) {
            $extension = Input::file('pic')->guessClientExtension();
            $slider->ext = '.' .$extension;
        }

        try {
            $slider->save();
        } catch (\Exception $e) {

            return Redirect::back()->with(
                'error',
                $e->getMessage()
            );
        }

        if ($extension) {
            $destinationPath = public_path().$slider->path;
            $picName = $slider->id.$slider->ext;
            Input::file('pic')->move(
                $destinationPath,
                $picName
            );
        }

        return Redirect::to(
            "/core/pages/$pageId/$secId/$itemId/slider"
        )->with(
            'success',
            'Congratulation!!, "'.$slider->name.'" slider image has been created successfully!!'
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
     * @param int $slideId of slider primary id
     * @return Response HTML view of 'core.contentType.sliders.details' with array data of 'pageId', 'secId', 'slide'
     */
    public function details($pageId, $secId, $itemId, $slideId)
    {
        if (!$pageId || !$secId || !$itemId || !$slideId) {

            return Redirect::to(
                '/core/error'
            )->with(
                'error',
                'Some thing is wrong, please contact to administrator!!'
            );
        }

        $slide = core\CoreSlider::where(
            'id',
            $slideId
        )->first();

        return View::make(
            'core.contentType.sliders.details',
            compact(
               'pageId',
                'secId',
                'itemId',
                'slide'
            )
        );
    }

    /**
     * @access public
     *
     * Update the slider properties
     *
     * @param int $slideId of slider primary id
     * @param string $part of 'core_sliders' table's field name
     * @return Response JSON Data
     */
    public function update($slideId, $part)
    {
        if (!$slideId || !$part) {

            return Response::Json(
                array(
                    'status' => 'error',
                    'msg' => 'Some thing is wrong, please contact to administrator!!'
                )
            );
        }

        $slider = core\CoreSlider::where(
            'id',
            $slideId
        )->first();

        if (!$slider) {

            return Response::Json(
                array(
                    'status' => 'error',
                    'msg' => 'Some thing is wrong, please contact to administrator!!'
                )
            );
        }

        if ($part == 'ext' && Input::hasFile('pic')) {

            $extension = Input::file('pic')->guessClientExtension();
            $beforeExt = $slider->ext;
            $query = $slider->update(
                array(
                    'ext' => ".$extension",
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

            $destinationPath = public_path().$slider->path;
            $picName = $slider->id.".$extension";
            File::Delete($destinationPath.$slider->id.$beforeExt);
            Input::file('pic')->move(
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

        if ($part == 'orderno') {
            $part = 'order_no';
        }

        if (!($data = trim(Input::get('value'))) && ($part == 'name' || $part == 'order_no')) {

            return Response::Json(
                array(
                    'status' => 'error',
                    'msg' => 'Some thing is wrong, please contact to administrator!!'
                )
            );
        }

        $query = $slider->update(
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

    /**
     * @access public
     *
     * Update the slider content JSON data
     *
     * @param int $slideId of slider primary id
     * @param string $part of 'core_sliders' table's field name 'content' JSON data
     * @return Response JSON Data
     */
    public function contentUpdate($slideId, $part)
    {
        if (!$slideId || !$part) {

            return Response::Json(
                array(
                    'status' => 'error',
                    'msg' => 'Some thing is wrong, please contact to administrator!!'
                )
            );
        }

        $slide = core\CoreSlider::where(
            'id',
            $slideId
        )->first();

        if (!$slide) {

            return Response::Json(
                array(
                    'status' => 'error',
                    'msg' => 'Some thing is wrong, please contact to administrator!!'
                )
            );
        }

        $arr = json_decode($slide->content, true);
        $data = trim(Input::get('value'));

        if ($part == 'pb') {
            $arr = json_encode(
                [
                    'pb' => $data == null? '0%': $data,
                    'pl' => $arr['pl'],
                    'pr' => $arr['pr'],
                    'tc' => $arr['tc'],
                    'dc' => $arr['dc']
                ]
            );
        }

        if ($part == 'pl') {
            $arr = json_encode(
                [
                    'pb' => $arr['pb'],
                    'pl' => $data == null? '0%': $data,
                    'pr' => $arr['pr'],
                    'tc' => $arr['tc'],
                    'dc' => $arr['dc']
                ]
            );
        }

        if ($part == 'pr') {
            $arr = json_encode(
                [
                    'pb' => $arr['pb'],
                    'pl' => $arr['pl'],
                    'pr' => $data == null? '0%': $data,
                    'tc' => $arr['tc'],
                    'dc' => $arr['dc']
                ]
            );

        }

        if ($part == 'tc') {
            $arr = json_encode(
                [
                    'pb' => $arr['pb'],
                    'pl' => $arr['pl'],
                    'pr' => $arr['pr'],
                    'tc' => $data == null? '#ffffff': $data,
                    'dc' => $arr['dc']
                ]
            );

        }

        if ($part == 'dc') {
            $arr = json_encode(
                [
                    'pb' => $arr['pb'],
                    'pl' => $arr['pl'],
                    'pr' => $arr['pr'],
                    'tc' => $arr['tc'],
                    'dc' => $data == null? '#ffffff': $data,
                ]
            );

        }

        $query = $slide->update(
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
