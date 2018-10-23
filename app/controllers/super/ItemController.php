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
use File;

/**
 * Class ItemController
 *
 * @extends base\CoreController
 * @package app\controllers\core
 */
class ItemController extends base\BaseController
{
    /**
     * @access public
     *
     * @param int $itemId of section's item primary id
     * @return Response HTML view of 'super.sections.details' with array 'page'
     */
    public function details($itemId)
    {
        if(!$itemId) {

            return Redirect::to(
                '/~super/error'
            )->with(
                'error',
                'Some thing is wrong, please contact to administrator!!'
            );
        }

        $item = core\CorePage::where(
            'id',
            $itemId
        )->where(
            'type',
            'item'
        )->first();

        if(!$item) {

            return Redirect::to(
                '/~super/error'
            )->with(
                'error',
                'Some thing is wrong, please contact to administrator!!'
            );
        }

        $siteUrl = $this->siteUrl();

        return View::make(
            'super.sections.items',
            compact(
               'item',
                'siteUrl'
            )
        );
    }

    /**
     * @access public
     *
     * Update the item content JSON data
     *
     * @param int $itemId of section's item primary id
     * @param string $part of 'core_pages' table's field name 'content' JSON data
     * @return Response JSON Data
     */
    public function contentUpdate($itemId, $part)
    {
        if (!$itemId || !$part) {

            return Response::Json(
                array(
                    'status' => 'error',
                    'msg' => 'Some thing is wrong, please contact to administrator!!'
                )
            );
        }

        $item = core\CorePage::where(
            'id',
            $itemId
        )->first();

        if (!$item) {

            return Response::Json(
                array(
                    'status' => 'error',
                    'msg' => 'Some thing is wrong, please contact to administrator!!'
                )
            );
        }

        $data = trim(Input::get('value'));

        $arr = json_decode($item->content, true);

        if ($part == 'cls') {
            $arr = json_encode(
                [
                    'l'  => $arr['l'],
                    'cls'=> $data == null? '' : $data,
                    'bc' => $arr['bc'],
                    'bs' => $arr['bs'],
                    't'  => $arr['t'],
                    'tag'=> $arr['tag'],
                    'fc' => $arr['fc'],
                    'rwc'=> $arr['rwc']
                ]
            );
        }

        if ($part == 't') {
            $arr = json_encode(
                [
                    'l'  => $arr['l'],
                    'cls'=> $arr['cls'],
                    'bc' => $arr['bc'],
                    'bs' => $arr['bs'],
                    't'  => $data == null? '' : $data,
                    'tag'=> $arr['tag'],
                    'fc' => $arr['fc'],
                    'rwc'=> $arr['rwc']
                ]
            );
        }

        if ($part == 'tag') {
            $arr = json_encode(
                [
                    'l'  => $arr['l'],
                    'cls'=> $arr['cls'],
                    'bc' => $arr['bc'],
                    'bs' => $arr['bs'],
                    't'  => $arr['t'],
                    'tag'=> $data == null? 'h1' : $data,
                    'fc' => $arr['fc'],
                    'rwc'=> $arr['rwc']
                ]
            );
        }

        if ($part == 'bc') {
            $arr = json_encode(
                [
                    'l'  => $arr['l'],
                    'cls'=> $arr['cls'],
                    'bc' => $data == null? '' : $data,
                    'bs' => $arr['bs'],
                    't'  => $arr['t'],
                    'tag'=> $arr['tag'],
                    'fc' => $arr['fc'],
                    'rwc'=> $arr['rwc']
                ]
            );
        }

        if ($part == 'rwc') {
            $arr = json_encode(
                [
                    'l'  => $arr['l'],
                    'cls'=> $arr['cls'],
                    'bc' => $arr['bc'],
                    'bs' => $arr['bs'],
                    't'  => $arr['t'],
                    'tag'=> $arr['tag'],
                    'fc' => $arr['fc'],
                    'rwc'=> $data == null? '2' : $data,
                ]
            );
        }

        $query = $item->update(
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
