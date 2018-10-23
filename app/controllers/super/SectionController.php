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
 * Class SectionController
 *
 * @extents base\BaseController
 * @package app\controllers\super
 */
class SectionController extends base\BaseController
{
    /**
     * @access public
     *
     * @return Response HTML view of 'super.sections.index'
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
            'super.sections.index',
            compact(
                'siteUrl',
                'pages'
            )
        );
    }

    /**
     * @access public
     *
     * 'GET' form for creating new section
     *
     * @return Response HTML partial view of 'super.sections.create'
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
            'super.sections.create',
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
     * @return Redirect to action 'SectionController@index' with flash message
     */
    public function store()
    {
        $data = Input::all();

        $rules = array(
            'page'  => 'required',
            'order' => 'required',
            'title' => 'required',
            'col'   => 'required',
            'type'  => 'required',
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
        $title = trim(Input::get('title'));
        $order = trim(Input::get('order'));

        $col = trim(Input::get('col'));
        $cls = trim(Input::get('cls'));
        $bColor = trim(Input::get('bColor'));
        $bs = trim(Input::get('bs'));
        $fColor = trim(Input::get('fColor'));

        $contentType = Input::get('type');
        $colName = Input::get('colName');
        $colColor = Input::get('colColor');
        $colTitle = Input::get('colTitle');

        $section = new core\CorePage();
        $section->title = $title;
        $section->parent_id = $pageId;
        $section->name = preg_replace('/\s+/', '-', strtolower($title));
        $section->content = json_encode(
            [
                'l'  => $col,
                'cls'=> $cls == null? '' : $cls,
                'bc' => $bColor == null? '#ffffff' : $bColor,
                'bs' => $bs == 0 ? false : true,
                't'  => '',
                'fc' => $fColor == null? '#ffffff' : $fColor
            ]
        );
        $section->type = 'section';
        $section->status = true;
        $section->section_order = $order;
        $section->guid = '';
        $section->uploaded_by = Auth::user()->username;
        $section->uploaded_date = date('Y-m-d H:i:s');
        $section->modified_by = Auth::user()->username;
        $section->modified_date = date('Y-m-d H:i:s');

        try {
            $section->save();
        } catch (\Exception $e) {

            return Redirect::back()->with(
                'error',
                $e->getMessage()
            );
        }

        $section->update(
            array(
                'guid' => '?section='.$section->id
            )
        );

        foreach ($contentType as $key => $type) {

            $item = new core\CorePage();
            $item->title = "$colName[$key] : ".$this->contentTypeName($type);
            $item->parent_id = $section->id;
            $item->name = preg_replace('/\s+/', '-', strtolower($item->title));
            $item->content = json_encode(
                [
                    'l'  => 'col-'.explode("-", $colName[$key])[1],
                    'cls'=> '',
                    'bc' => $colColor[$key],
                    'bs' => false,
                    't'  => $colTitle[$key],
                    'tag'=> 'h1',
                    'fc' => '',
                    'rwc' => '4'
                ]
            );
            $item->type = 'item';
            $item->content_type = $type;
            $item->status = true;
            $item->uploaded_by = Auth::user()->username;
            $item->uploaded_date = date('Y-m-d H:i:s');
            $item->modified_by = Auth::user()->username;
            $item->modified_date = date('Y-m-d H:i:s');
            $item->save();
        }

        return Redirect::to(
            '/~super/pages/sections'
        )->with(
            'success',
            'Congratulation!!, "'.$section->title.'" section has been created successfully!!'
        );
    }

    /**
     * @access private
     *
     * Gets short name of content type and return full name
     *
     * @param string $type of short name of content type
     * @return string of full name of content type
     */
    private function contentTypeName($type)
    {
        switch ($type) {
            case 'slider':
                return 'Image Slider';
            case 'post':
                return 'Content Post';
            case 'news':
                return 'Newsletter';
            case 'gallery':
                return 'Image Gallery';
            case 'profile':
                return 'Image Gallery With Profile';
            case 'banner':
                return 'Image Banner';
            case 'cForm':
                return 'Contact Form';
        }
    }

    /**
     * @access public
     *
     * @param int $secId of section primary id
     * @return Response HTML view of 'super.sections.details' with array 'page'
     */
    public function details($secId)
    {
        if(!$secId) {

            return Redirect::to(
                '/~super/error'
            )->with(
                'error',
                'Some thing is wrong, please contact to administrator!!'
            );
        }

        $sec = core\CorePage::with(
            'items'
        )->where(
            'id',
            $secId
        )->first();

        $layout = json_decode($sec->content, true);
        $siteUrl = $this->siteUrl();

        return View::make(
            'super.sections.details',
            compact(
                'siteUrl',
                'sec',
                'layout'
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
    public function update($secId, $part)
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

    /**
     * @access public
     *
     * Update the section content JSON data
     *
     * @param int $secId of section primary id
     * @param string $part of 'core_pages' table's field name 'content' JSON data
     * @return Response JSON Data
     */
    public function contentUpdate($secId, $part)
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

        $data = trim(Input::get('value'));
        $arr = json_decode($sec->content, true);

        if ($part == 'cls') {
            $arr = json_encode(
                [
                    'l'  => $arr['l'],
                    'cls'=> $data == null? '' : $data,
                    'bc' => $arr['bc'],
                    'bs' => $arr['bs'],
                    't'  => $arr['t'],
                    'fc' => $arr['fc']
                ]
            );
        }

        if ($part == 'bc') {
            $arr = json_encode(
                [
                    'l'  => $arr['l'],
                    'cls'=> $arr['cls'],
                    'bc' => $data == null? '#ffffff' : $data,
                    'bs' => $arr['bs'],
                    't'  => $arr['t'],
                    'fc' => $arr['fc']
                ]
            );
        }

        if ($part == 'bs') {
            $arr = json_encode(
                [
                    'l'  => $arr['l'],
                    'cls'=> $arr['cls'],
                    'bc' => $arr['bc'],
                    'bs' => $data == null? false : $data,
                    't'  => $arr['t'],
                    'fc' => $arr['fc']
                ]
            );

        }

        if ($part == 'fc') {
            $arr = json_encode(
                [
                    'l'  => $arr['l'],
                    'cls'=> $arr['cls'],
                    'bc' => $arr['bc'],
                    'bs' => $arr['bs'],
                    't'  => $arr['t'],
                    'fc' => $data == null? '#ffffff' : $data
                ]
            );

        }

        $query = $sec->update(
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
