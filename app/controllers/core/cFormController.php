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
 * Class cFormController
 *
 * @extends base\CoreController
 * @package app\controllers\core
 */
class cFormController extends base\CoreController
{
    /**
     * @access public
     *
     * POST data are verified by laravel validator class
     *
     * Failed validator is redirect back to with flash message
     *
     * Data are being stored and updated inside database table 'core_pages'
     *
     * @return Redirect back to same page with flash message
     */
    public function store()
    {
        $data = Input::all();

        $rules = array(
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

        $title = trim(Input::get('title'));
        $content = trim(Input::get('content'));

        if (!($cFormId = trim(Input::get('cFormId')))) {

            $post = new core\CorePage();
            $post->title = $title == null ? '' : $title;
            $post->parent_id = $itemId;
            $post->name = preg_replace('/\s+/', '_', strtolower($post->title));
            $post->content = $content;
            $post->type = 'content';
            $post->content_type = 'cForm';
            $post->status = true;
            $post->uploaded_by = Auth::user()->username;
            $post->uploaded_date = date('Y-m-d H:i:s');
            $post->modified_by = Auth::user()->username;
            $post->modified_date = date('Y-m-d H:i:s');

            try {
                $post->save();
            } catch (\Exception $e) {

                return Redirect::back()->with(
                    'error',
                    $e->getMessage()
                );
            }
        } else {

            core\CorePage::where(
                'id',
                $cFormId
            )->update(
                array(
                    'title' => $title == null ? '' : $title,
                    'name' => preg_replace('/\s+/', '_', strtolower($title)),
                    'content' => $content
                )
            );
        }

        return Redirect::back()->with(
            'success',
            'Contact Form has been updated!!'
        );
    }

}
