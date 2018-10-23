<?php
namespace app\controllers\core;

use app\controllers\base;
use View;
use Input;
use Redirect;
use File;


/**
 * Class CodeEditController
 *
 * @extends base\CoreController
 * @package app\controllers\core
 */
class CodeEditController extends base\CoreController
{
    /**
     * @access public
     *
     * All Custom CSS code view for editing
     *
     * @return Response HTML view of 'core.code.index'
     */
    public function index()
    {
        $code = File::get(public_path().'/assets/web/css/userCustom.css');

        return View::make(
            'core.code.index',
            compact(
                'code'
            )
        );
    }

    /**
     * @access public
     *
     * Old file is being deleted and new content paste to new file
     *
     * @return Redirect to action 'CodeEditController@index' with flash message
     */
    public function update()
    {
        $path = public_path().'/assets/web/css/userCustom.css';
        File::Delete($path);
        File::put($path, Input::get('cssCode'));

        return Redirect::to(
            '/core/code'
        )->with(
            'success',
            'CSS has been updated!!'
        );
    }

}
