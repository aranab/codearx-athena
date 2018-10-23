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
 * Class QuestionController
 *
 * @extends base\CoreController
 * @package app\controllers\core
 */
class QuestionController extends base\CoreController
{
    /**
     * @access public
     *
     * GET a list of Live questions show in grid data table base on input format.
     *
     * @return Response HTML view of 'core.questions.index' with array of 'txtQ', 'fileQ'
     */
    public function index()
    {
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
            'core.questions.index',
            compact(
                'txtQ',
                'fileQ'
            )
        );
    }

    /**
     * @access public
     *
     * 'GET' form for creating new question
     *
     * @return Response HTML view of 'core.questions.create'
     */
    public function create()
    {
        return View::make(
            'core.questions.create'
        );
    }

    /**
     * @access public
     *
     * POST data has been verified, if null is found then it is made a error message.
     *
     * Data are being stored inside database table 'core_pages
     *
     * @return Redirect to action 'QuestionController@index' with flash message
     */
    public function store()
    {
        $data = Input::all();

        $rules = array(
            'format' => 'required',
            'order' => 'required',
            'question' => 'required'
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

        $format = trim(Input::get('format'));
        $order = trim(Input::get('order'));
        $question = trim(Input::get('question'));

        $q = new core\CoreQuestion();
        $q->question = $question;
        $q->format = $format;
        $q->status = true;
        $q->order_no = $order;
        $q->uploaded_by = Auth::user()->username;
        $q->uploaded_date = date('Y-m-d H:i:s');
        $q->modified_by = Auth::user()->username;
        $q->modified_date = date('Y-m-d H:i:s');

        try {
            $q->save();
        } catch (\Exception $e) {

            return Redirect::back()->with(
                'error',
                $e->getMessage()
            );
        }

        return Redirect::to(
            '/core/questions'
        )->with(
            'success',
            'Question has been created successfully!!'
        );
    }

    /**
     * @access public
     *
     * 'GET' details of selected question
     *
     * @param int $qId of question primary id of table name 'core_questions'
     * @return Response HTML view of 'core.contentType.banner.details' with array data of 'pageId', 'secId', 'banner'
     */
    public function details($qId)
    {
        if (!$qId) {

            return Redirect::to(
                '/core/error'
            )->with(
                'error',
                'Some thing is wrong, please contact to administrator!!'
            );
        }

        $question = core\CoreQuestion::where(
            'id',
            $qId
        )->first();

        return View::make(
            'core.questions.details',
            compact(
                'question'
            )
        );
    }

    /**
     * @access public
     *
     * Update the question properties
     *
     * @param int $qId of question primary id of table name 'core_questions'
     * @param string $part of 'core_questions' table's field name
     * @return Response JSON Data
     */
    public function update($qId, $part)
    {
        if (!$qId || !$part) {

            return Response::Json(
                array(
                    'status' => 'error',
                    'msg' => 'Some thing is wrong, please contact to administrator!!'
                )
            );
        }

        $q = core\CoreQuestion::where(
            'id',
            $qId
        )->first();

        if (!$q) {

            return Response::Json(
                array(
                    'status' => 'error',
                    'msg' => 'Some thing is wrong, please contact to administrator!!'
                )
            );
        }

        if ($part == 'orderno') {
            $part = 'order_no';
        }

        if (($data = trim(Input::get('value'))) == null) {

            return Response::Json(
                array(
                    'status' => 'error',
                    'msg' => 'Some thing is wrong, please contact to administrator!!'
                )
            );
        }

        $query = 1;
        if ($q->$part != $data) {
            $query = $q->update(
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
     * GET a list of all questions show in grid data table.
     *
     * @return Response HTML view of 'core.questions.log' with array of 'questions'
     */
    public function logs()
    {
        $questions = core\CoreQuestion::all();

        return View::make(
            'core.questions.log',
            compact(
                'questions'
            )
        );
    }

}
