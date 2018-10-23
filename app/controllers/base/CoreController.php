<?php
namespace app\controllers\base;

use Illuminate\Routing\Controller;
use app\models\core;
use app\models\super;
use View;

/**
 * Class CoreController
 *
 * @extends Controller
 * @package app\controllers\base
 */
class CoreController extends Controller
{
    /**
     * @access public
     *
     * CoreController constructor.
     */
    public function __construct()
    {}

    /**
     * @access public
     *
     * This is view composer method that is called when 'web.layout' master layout define.
     *
     * Return CMS configuration array and 'pageName' array for side bar menu
     *
     * @param object $view of 'web.layout'
     */
    public function config($view)
    {
        $configs = super\CMSConfig::all();
        $pageName = core\CorePage::where(
            'type',
            'page'
        )->lists(
            'title',
            'id'
        );

        $view->with(
            array(
                'pageMenu'  => $pageName,
                'configs' => $configs
            )
        );
    }


}

View::composers(
    array(
        'app\controllers\base\CoreController@config' => 'core.layout',
    )
);
