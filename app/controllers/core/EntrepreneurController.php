<?php
namespace app\controllers\core;

use app\controllers\base;
use app\models\core;
use app\models\web;
use View;
use Input;
use Redirect;
use Validator;
use Response;
use Auth;
use File;

/**
 * Class EntrepreneurController
 *
 * @extends base\CoreController
 * @package app\controllers\core
 */
class EntrepreneurController extends base\CoreController
{
    /**
     * @access public
     *
     * GET a list of user's ideas where status is pending
     *
     * @return Response HTML view of 'core.entrepreneur.index' with array of 'ideas'
     */
    public function index()
    {
        $ideas = web\IdeaUser::with(
            'user'
        )->whereIn(
            'status',
            [1, 2]
        )->get();

        return View::make(
            'core.entrepreneur.index',
            compact(
                'ideas'
            )
        );
    }

    /**
     * @access public
     *
     * 'GET' details of selected idea
     *
     * @param int $id of user idea primary id of table name 'idea_users'
     * @return Response HTML view of 'core.entrepreneur.details' with array data of 'idea'
     */
    public function details($id)
    {
        if (!$id) {

            return Redirect::to(
                '/core/error'
            )->with(
                'error',
                'Some thing is wrong, please contact to administrator!!'
            );
        }

        $idea = web\IdeaUser::where(
            'id',
            $id
        )->first();

        if ($idea->status == 1) {
            $idea->update(
                [
                    'status' => 2,
                    'modified_by' => Auth::user()->username,
                    'modified_date' => date('Y-m-d H:i:s')
                ]
            );

            $log = new web\LogIdeaUser();
            $log->idea_user_id = $id;
            $log->status = 2;
            $log->uploaded_by = Auth::user()->username;
            $log->uploaded_date = date('Y-m-d H:i:s');
        }

        $idea = web\IdeaUser::with(
            array(
                'user',
                'answers' => function ($q) {
                    $q->with(
                        'question'
                    );
                }
            )
        )->where(
            'id',
            $id
        )->first();

        if (!$idea) {
            return Redirect::to(
                '/core/error'
            )->with(
                'error',
                'Some thing is wrong, please contact to administrator!!'
            );
        }

        $count = web\IdeaUser::where(
            'user_id',
            $idea->user_id
        )->count();

        return View::make(
            'core.entrepreneur.details',
            compact(
                'idea',
                'count'
            )
        );
    }

    /**
     * @access public
     *
     * Update the idea properties status
     *
     * @param int $id of idea user primary id
     * @return @return Redirect to action 'PagesController@sectionItem' with flash message
     */
    public function updateStatus($id)
    {
        if (!$id) {

            return Redirect::to(
                '/core/error'
            )->with(
                'error',
                'Some thing is wrong, please contact to administrator!!'
            );
        }

        $idea = web\IdeaUser::where(
            'id',
            $id
        )->update(
            [
                'status' => \Input::get('dropStatus'),
                'remarks' => \Input::get('remark'),
                'modified_by' => \Auth::user()->username,
                'modified_date' => date('Y-m-d H:i:s')
            ]
        );

        if (!$idea) {

            return \Redirect::back()->with(
                'error',
                'Some thing is wrong, please contact to administrator!!'
            );
        }

        $log = new web\LogIdeaUser();
        $log->idea_user_id = $id;
        $log->status = \Input::get('dropStatus');
        $log->uploaded_by = \Auth::user()->username;
        $log->uploaded_date = date('Y-m-d H:i:s');

        return \Redirect::to(
            "/core/ideas/$id"
        )->with(
            'success',
            'Status has been updated successfully!!'
        );
    }

    /**
     * @access public
     *
     * 'GET' total submission log of selected user id
     *
     * @param int $userId of user foreign id of table name 'idea_users'
     * @return Response HTML view of 'core.entrepreneur.total' with array data of 'ideas'
     */
    public function total($userId)
    {
        if (!$userId) {

            return Redirect::to(
                '/core/error'
            )->with(
                'error',
                'Some thing is wrong, please contact to administrator!!'
            );
        }

        $user = core\CoreUser::with(
            array(
                'ideas'
            )
        )->where(
            'id',
            $userId
        )->first();

        return View::make(
            'core.entrepreneur.total',
            compact(
                'user'
            )
        );
    }

    /**
     * @access public
     *
     * GET a list of all accepted and rejected ideas show in grid data table.
     *
     * @return Response HTML view of 'core.questions.log' with array of 'questions'
     */
    public function logs()
    {
        $ideas = web\IdeaUser::with(
            'user'
        )->whereIn(
            'status',
            [0, 3]
        )->get();

        return View::make(
            'core.entrepreneur.log',
            compact(
                'ideas'
            )
        );
    }

}
