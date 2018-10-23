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
 * Class WidgetController
 *
 * @extends base\CoreController
 * @package app\controllers\core
 */
class WidgetController extends base\CoreController
{
    /**
     * @access public
     *
     * @return Response HTML view of 'core.pages.index'
     */
    public function index()
    {
        $widget = core\CorePage::where(
            'type',
            'widget'
        )->where(
            'content_type',
            'post'
        )->first();

        if (!$widget) {
            $widget = new core\CorePage();
        }

        return View::make(
            'core.pages.widget',
            compact(
                'widget'
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
     * Data are being stored and updated inside database table 'core_pages'
     *
     * @return Redirect back to same page with flash message
     */
    public function update()
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

        $title = trim(Input::get('title'));
        $content = trim(Input::get('content'));

        if (!($wId = trim(Input::get('wId')))) {

            $widget = new core\CorePage();
            $widget->title = $title == null ? '' : $title;
            $widget->name = preg_replace('/\s+/', '_', strtolower($widget->title));
            $widget->content = $content;
            $widget->type = 'widget';
            $widget->content_type = 'post';
            $widget->status = true;
            $widget->uploaded_by = Auth::user()->username;
            $widget->uploaded_date = date('Y-m-d H:i:s');
            $widget->modified_by = Auth::user()->username;
            $widget->modified_date = date('Y-m-d H:i:s');

            try {
                $widget->save();
            } catch (\Exception $e) {

                return Redirect::back()->with(
                    'error',
                    $e->getMessage()
                );
            }
        } else {

            core\CorePage::where(
                'id',
                $wId
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
            'Widget has been updated!!'
        );
    }

}
