<?php
namespace app\controllers\super;

use app\controllers\base;
use View;
use Input;
use Redirect;
use File;


/**
 * Class CodeEditController
 *
 * @extends base\BaseController
 * @package app\controllers\super
 */
class CodeEditController extends base\BaseController
{
    /**
     * @access public
     *
     * All Custom CSS code view for editing
     *
     * @return Response HTML view of 'super.code.index'
     */
    public function index()
    {
        $code = File::get(public_path().'/assets/web/css/userCustom.css');

        return View::make(
            'super.code.index',
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
            '/~super/code'
        )->with(
            'success',
            'CSS has been updated!!'
        );
    }

}
