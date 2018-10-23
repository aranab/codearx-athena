<?php
namespace app\controllers\super;

use app\controllers\base;
use View;
use Session;

/**
 * Class HomeController
 *
 * @extends base\BaseController
 * @package app\controllers\super
 */
class HomeController extends base\BaseController
{
    /**
     * @access public
     *
     * @return Response HTML view of 'super.index'
     */
    public function index()
    {
        return View::make(
            'super.index'
        );
    }

    /**
     * @access public
     *
     * @return Response HTML view of 'super.error'
     */
    public function error()
    {
        $error = '';
        if (Session::has('error')) {
            $error = Session::get('error');
        }

        return View::make(
            'super.error'
        )->with(
            'error',
            $error
        );
    }

}
