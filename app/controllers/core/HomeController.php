<?php
namespace app\controllers\core;

use app\controllers\base;
use View;
use Session;

/**
 * Class HomeController
 *
 * @extends base\CoreController
 * @package app\controllers\core
 */
class HomeController extends base\CoreController
{
    /**
     * @access public
     *
     * @return Response HTML view of 'core.index'
     */
    public function index()
    {
        return View::make(
            'core.index'
        );
    }

    /**
     * @access public
     *
     * @return Response HTML view of 'core.error'
     */
    public function error()
    {
        $error = '';
        if (Session::has('error')) {
            $error = Session::get('error');
        }

        return View::make(
            'core.error'
        )->with(
            'error',
            $error
        );
    }

}
