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
 * Class MediaController
 *
 * @extends base\CoreController
 * @package app\controllers\core
 */
class MediaController extends base\CoreController
{
    /**
     * @access public
     *
     * Gets the all images from 'core_pages' table
     *
     * @return Response HTML view of 'core.media.index'
     */
    public function index()
    {
        $media = core\CorePage::where(
            'type',
            'image'
        )->where(
            'content_type',
            'attachment'
        )->get();

        return View::make(
            'core.media.index',
            compact(
                'media'
            )
        );
    }

    /**
     * @access public
     *
     * 'GET' form for creating new page
     *
     * @return Response HTML partial view of 'core.media._create'
     */
    public function create()
    {
        return View::make(
            'core.media._create'
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
     * @return Redirect to action 'MediaController@index' with flash message
     */
    public function store()
    {
        $data = Input::all();

        $rules = array(
            'file' => 'required|max:1600|mimes:jpeg,png,mp4',
        );

        $validator = Validator::make(
            $data,
            $rules
        );

        if ($validator->fails()) {

            return Redirect::back()->with(
                'error',
                'Please upload correct format file.'
            );
        }

        $file = Input::file('file');

        $upload = new core\CorePage();
        $upload->title = $file->getClientOriginalName();
        $upload->name = preg_replace('/\s+/', '-', $upload->title);
        $upload->type = explode('/', $file->getMimeType())[0];
        $upload->content_type = 'attachment';
        $upload->status = true;
        $upload->mime_type = $file->getMimeType();
        $upload->guid = '';
        $upload->uploaded_by = Auth::user()->username;
        $upload->uploaded_date = date('Y-m-d H:i:s');
        $upload->modified_by = Auth::user()->username;
        $upload->modified_date = date('Y-m-d H:i:s');

        try {
            $upload->save();
        } catch (\Exception $e) {

            return Redirect::back()->with(
                'error',
                $e->getMessage()
            );
        }

        $upload->update(
            array(
                'guid' => '/upload/media/'.$upload->id.'.'.$file->guessClientExtension()
            )
        );

        $destinationPath = public_path().'/upload/media/';
        $picName = $upload->id.'.'.$file->guessClientExtension();
        $file->move(
            $destinationPath,
            $picName
        );

        return Redirect::to(
            '/core/media'
        )->with(
            'success',
            "$upload->type attachment has been uploaded!!"
        );
    }

    /**
     * @access public
     *
     *  Ajax request attempts to delete the media file forever
     *
     * @param int $mediaId of media primary id from 'core_pages'
     * @return Response JSON Data
     */
    public function delete($mediaId)
    {
        if (!$mediaId) {

            return Response::Json(
                array(
                    'status' => 'error',
                    'msg' => 'Some thing is wrong, please contact to administrator!!'
                )
            );
        }

        $media = core\CorePage::where(
            'id',
            $mediaId
        )->first();

        try {
            File::Delete(public_path().$media->guid);
        } catch (\Exception $e) {
            return Response::Json(
                array(
                    'status' => 'error',
                    'msg' => 'Some thing is wrong, please contact to administrator!!'
                )
            );
        }

        if ($media->delete()) {

            return Response::Json(
                array(
                    'status' => 'ok',
                    'msg' => 'Media file has been deleted!!'
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
