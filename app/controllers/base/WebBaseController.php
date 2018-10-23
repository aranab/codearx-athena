<?php
namespace app\controllers\base;

use Illuminate\Routing\Controller;
use app\models\core;
use app\models\super;

/**
 * Class WebBaseController
 *
 * @extends Controller
 * @package app\controllers\base
 */
class WebBaseController extends Controller
{
    /**
     * @access public
     *
     * WebBaseController constructor.
     */
    public function __construct()
    {}

    /**
     * @access public
     *
     * This is view composer method that is called when 'web.layout' master layout define.
     *
     * Return CMS configuration array and 'page menu' array for top menu bar
     *
     * @param object $view of 'web.layout'
     */
    public function configLayout($view)
    {
        $configs = super\CMSConfig::all();
        $menu = core\CorePage::where(
            'type',
            'menu'
        )->get(
            ['title', 'guid']
        );

        $view->with(
            array(
                'topMenu'  => $menu,
                'configs' => $configs
            )
        );
    }

    /**
     * @access public
     *
     * This is view composer method that is called when 'web.layoutD' master layout define.
     *
     * Return CMS configuration array and 'page menu' array for top menu bar
     *
     * @param object $view of 'web.layoutD'
     */
    public function configLayoutD($view)
    {
        $configs = super\CMSConfig::all();
        $menu = core\CorePage::where(
            'type',
            'menu'
        )->get(
            ['title', 'guid']
        );

        $view->with(
            array(
                'topMenu'  => $menu,
                'configs' => $configs
            )
        );
    }

}

\View::composers(
    array(
        'app\controllers\base\WebBaseController@configLayout' => 'web.layout',
        'app\controllers\base\WebBaseController@configLayoutD' => 'web.layoutD'
    )
);

\Validator::extend('maxwords', function($attribute, $value, $parameters, $validator) {
    $words = preg_split( '@\s+@i', trim( $value ) );
    if ( count( $words ) <= $parameters[ 0 ] ) {
        return true;
    }
    return false;
});

\Validator::replacer('maxwords', function($message, $attribute, $rule, $parameters) {
    return str_replace(':maxwords', $parameters[0], $message);
});