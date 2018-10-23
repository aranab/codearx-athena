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
 * Class NewsController
 *
 * @extends base\CoreController
 * @package app\controllers\core
 */
class NewsController extends base\CoreController
{
    /**
     * @access public
     *
     * 'GET' form for creating new news
     *
     * @param int $pageId of page primary id
     * @param int $secId of section primary id
     * @param int $itemId of section item's primary id
     * @return Response HTML view of 'core.contentType.news.create'
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
            'core.contentType.news.create',
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
            'description' => 'required|max:200',
            'pic' => 'required|max:1600|mimes:jpeg,png',
            'content' => 'required'
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

        $news = new core\CorePage();
        $news->title = trim(Input::get('title'));
        $news->parent_id = $itemId;
        $news->name = preg_replace('/\s+/', '_', strtolower($news->title));
        $news->content = trim(Input::get('description'));
        $news->type = 'content';
        $news->content_type = 'news';
        $news->status = true;
        $news->guid = '';
        $news->uploaded_by = Auth::user()->username;
        $news->uploaded_date = date('Y-m-d H:i:s');
        $news->modified_by = Auth::user()->username;
        $news->modified_date = date('Y-m-d H:i:s');

        try {
            $news->save();
        } catch (\Exception $e) {

            return Redirect::back()->with(
                'error',
                $e->getMessage()
            );
        }

        $news->update(
            array(
                'guid' => '?news='.$news->id
            )
        );

        $pic = Input::file('pic');
        $newsDetails = new core\CorePage();
        $newsDetails->title = trim(Input::get('title'));
        $newsDetails->parent_id = $news->id;
        $newsDetails->name = preg_replace('/\s+/', '_', strtolower($news->title));
        $newsDetails->content = trim(Input::get('content'));
        $newsDetails->type = 'content';
        $newsDetails->content_type = 'news-details';
        $newsDetails->status = true;
        $newsDetails->mime_type = $pic->getMimeType();
        $newsDetails->guid = '';
        $newsDetails->uploaded_by = Auth::user()->username;
        $newsDetails->uploaded_date = date('Y-m-d H:i:s');
        $newsDetails->modified_by = Auth::user()->username;
        $newsDetails->modified_date = date('Y-m-d H:i:s');

        try {
            $newsDetails->save();
        } catch (\Exception $e) {

            return Redirect::back()->with(
                'error',
                $e->getMessage()
            );
        }

        $newsDetails->update(
            array(
                'guid' => '/upload/gallery/'.$newsDetails->id.'.'.$pic->guessClientExtension()
            )
        );

        $destinationPath = public_path().'/upload/gallery/';
        $picName = $newsDetails->id.'.'.$pic->guessClientExtension();
        $pic->move(
            $destinationPath,
            $picName
        );

        return Redirect::to(
            "/core/pages/$pageId/$secId/$itemId/news"
        )->with(
            'success',
            'Congratulation!!, Newsletter has been created successfully!!'
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
     * @param int $newsId of news primary id
     * @return Response HTML view of 'core.contentType.news.details' with array data of 'pageId', 'secId', 'slide'
     */
    public function details($pageId, $secId, $itemId, $newsId)
    {
        if (!$pageId || !$secId || !$itemId || !$newsId) {

            return Redirect::to(
                '/core/error'
            )->with(
                'error',
                'Some thing is wrong, please contact to administrator!!'
            );
        }

        $news = core\CorePage::with(
            'newsDetails'
        )->where(
            'id',
            $newsId
        )->first();

        return View::make(
            'core.contentType.news.details',
            compact(
                'pageId',
                'secId',
                'itemId',
                'news'
            )
        );
    }

    /**
     * @access public
     *
     * Ajax request update the news content
     *
     * @param int $newsId of news primary id from 'core_pages'
     * @param string $part of 'core_pages' table's field name
     * @return Response JSON Data
     */
    public function update($newsId, $part)
    {
        if (!$newsId || !$part) {

            return Response::Json(
                array(
                    'status' => 'error',
                    'msg' => 'Some thing is wrong, please contact to administrator!!'
                )
            );
        }

        $news = core\CorePage::where(
            'id',
            $newsId
        )->first();

        if (!$news) {

            return Response::Json(
                array(
                    'status' => 'error',
                    'msg' => 'Some thing is wrong, please contact to administrator!!'
                )
            );
        }

        if ($part == 'ext' && Input::hasFile('pic')) {

            $pic = Input::file('pic');
            File::Delete(public_path().$news->guid);
            $query = $news->update(
                array(
                    'mime_type' => $pic->getMimeType(),
                    'guid' => '/upload/gallery/'.$news->id.'.'.$pic->guessClientExtension(),
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
            $picName = $news->id.'.'.$pic->guessClientExtension();
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

        if (!($data = trim(Input::get('value')))) {

            return Response::Json(
                array(
                    'status' => 'error',
                    'msg' => 'Some thing is wrong, please contact to administrator!!'
                )
            );
        }

        $query = $news->update(
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
