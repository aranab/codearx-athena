<?php
namespace app\controllers\web;

use app\controllers\base as web;
use app\models\web as modelWeb;
use app\models\core;
use app\models\super;
use View;
use Auth;

/**
 * Class IdeaController
 * @extend web\WebBaseController
 * @package app\controllers\web
 */
class IdeaController extends web\WebBaseController
{
    /**
     * @access public
     *
     * Get Live Questions base on input type for submission idea
     *
     * @return Response HTML view of 'web.dashboard.idea.create'
     */
    public function create()
    {
        $countIdea = modelWeb\IdeaUser::where(
            'user_id',
            Auth::user()->id
        )->count();

        $configs = super\CMSConfig::where(
            'id',
            11
        )->first();

        if ($countIdea >= trim($configs->value)) {

            return \Redirect::to(
                '/user/warning'
            )->with(
                'warning',
                'Your idea submission limit has been exceed!!'
            );
        }

        $txtQ = core\CoreQuestion::where(
            'format',
            'txt'
        )->where(
            'status',
            1
        )->orderBy(
            'order_no',
            'asc'
        )->get();

        $fileQ = core\CoreQuestion::where(
            'format',
            'file'
        )->where(
            'status',
            1
        )->orderBy(
            'order_no',
            'asc'
        )->get();

        return View::make(
            'web.dashboard.idea.create',
            compact(
                'txtQ',
                'fileQ'
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
     * Data are being stored inside database table 'idea_users', 'log_idea_users' and 'idea_users_answers' respectively
     *
     * @return Redirect to action 'DashboardController@index' with flash message
     */
    public function store()
    {
        $data = \Input::all();

        $rules = [];
        $message = [];
        foreach (\Input::get('qt') as $key => $qId) {
            $rules['at.'.$qId] = 'required|maxwords:250';
            $message['at.'.$qId.'.required'] = 'Please write some words!';
            $message['at.'.$qId.'.maxwords'] = 'Please write maximum :maxwords word!';
        }

        foreach (\Input::get('qa') as $key => $qId) {
            $rules['aa.'.$qId] = 'required|mimes:pdf';
            $message['aa.'.$qId.'.required'] = 'Please upload your file!';
            $message['aa.'.$qId.'.mimes'] = 'Only pdf is required!';
        }

        $validator = \Validator::make(
            $data,
            $rules,
            $message
        );

        if ($validator->fails()) {

            return \Redirect::back()->withErrors(
                $validator
            )->withInput();
        }

        $idea = new modelWeb\IdeaUser();
        $idea->user_id = Auth::user()->id;
        $idea->status = 1;
        $idea->uploaded_by = Auth::user()->username;
        $idea->uploaded_date = date('Y-m-d H:i:s');

        try {
            $idea->save();
        } catch (\Exception $e) {

            return Redirect::back()->with(
                'error',
                'We are extremely sorry. Some problem arrived suddenly, please try again few times later!!'
            );
        }

        $log = new modelWeb\LogIdeaUser();
        $log->idea_user_id = $idea->id;
        $log->status = 1;
        $log->uploaded_by = Auth::user()->username;
        $log->uploaded_date = date('Y-m-d H:i:s');

        try {
            $log->save();
        } catch (\Exception $e) {
            //TODO: make a text base log report for manually delete this idea user's entry, other wise users loose
            // their idea submitted chance
            return Redirect::back()->with(
                'error',
                'We are extremely sorry. Some problem arrived suddenly, please try again few times later!!'
            );
        }

        $at = \Input::get('at');
        foreach (\Input::get('qt') as $key => $qId) {
            $ans = new modelWeb\IdeaUserAnswer();
            $ans->idea_user_id = $idea->id;
            $ans->question_id = $qId;
            $ans->content = $at[$qId];
            try {
                $ans->save();
            } catch (\Exception $e) {
                //TODO: make a text base log report for manually delete this idea user's entry, other wise users loose
                // their idea submitted chance
                return Redirect::back()->with(
                    'error',
                    'We are extremely sorry. Some problem arrived suddenly, please try again few times later!!'
                );
            }
        }

        $aa = \Input::file('aa');
        foreach (\Input::get('qa') as $key => $qId) {
            $ans = new modelWeb\IdeaUserAnswer();
            $ans->idea_user_id = $idea->id;
            $ans->question_id = $qId;
            $ans->mime_type = $aa[$qId]->getMimeType();
            $ans->guid = '/upload/entrepreneur/'.Auth::user()->id.'/'.$qId.'.'.$aa[$qId]->guessClientExtension();
            try {
                $ans->save();
            } catch (\Exception $e) {
                //TODO: make a text base log report for manually delete this idea user's entry, other wise users loose
                // their idea submitted chance
                return Redirect::back()->with(
                    'error',
                    'We are extremely sorry. Some problem arrived suddenly, please try again few times later!!'
                );
            }
            $destinationPath = public_path().'/upload/entrepreneur/'.Auth::user()->id.'/';
            $fileName = $qId.'.'.$aa[$qId]->guessClientExtension();
            $aa[$qId]->move(
                $destinationPath,
                $fileName
            );
        }

        return \Redirect::to(
            "/user/dashboard"
        )->with(
            'success',
            'Congratulation!!, Your Idea has been submitted successfully!!'
        );
    }

    /**
     * @access public
     *
     * 'GET' details of selected image
     *
     * @param int $ideaUserId of idea_users primary id
     * @return Response HTML view of 'core.contentType.profileGallery.details' with array data of 'pageId', 'secId',
     * 'itemId', 'prf'
     */
    public function details($ideaUserId)
    {
        if (!$ideaUserId) {

            return \Redirect::to(
                '/user/warning'
            )->with(
                'warning',
                'We are extremely sorry. Some problem arrived suddenly, please try again few times later!!'
            );
        }

        $idea = modelWeb\IdeaUser::with(
            array(
                'answers' => function ($q) {
                    $q->with(
                        'question'
                    );
                }
            )
        )->where(
            'id',
            $ideaUserId
        )->where(
            'user_id',
            Auth::user()->id
        )->first();

        if (!$idea) {

            return \Redirect::to(
                '/user/warning'
            )->with(
                'warning',
                'Something terrible here, your request cannot be processed!!'
            );
        }

        return View::make(
            'web.dashboard.idea.details',
            compact(
                'idea'
            )
        );
    }

    /**
     * @access public
     *
     * 'GET' download the attachment file
     *
     * @param int $ideaUserId of idea_users primary id
     * @param  int $ideaUserAnsId of idea_users_answers primary id
     * @return Response download the file
     */
    public function download($ideaUserId, $ideaUserAnsId)
    {
        $download = modelWeb\IdeaUserAnswer::where(
            'id',
            $ideaUserAnsId
        )->first();

        if ($download->mime_type)
        {
            $path = public_path().$download->guid;
            $fileName = 'attachment.'.explode('/', $download->mime_type)[1];

            $headers = array (
                'Content-Type:'. $download->mime_type,
                'Content-Disposition: attachment',
                "filename=$fileName"
            );

            return \Response::download($path, $fileName, $headers);
        }

        return;
    }

}