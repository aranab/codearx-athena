<?php
namespace app\controllers\base;

use Illuminate\Routing\Controller;
use app\models\super\CMSConfig;

/**
 * Class BaseController
 *
 * @extends Controller
 * @package app\controllers\base
 */
class BaseController extends Controller
{
    /**
     * @access public
     *
     * BaseController constructor.
     */
    public function __construct()
    {}

    /**
     * @access public static
     *
     * CMS options configuration values are being available for all views
     *
     * @return string of 'site url' from 'cms_configs' table
     */
	public static function siteUrl()
    {
        return CMSConfig::where(
            'name',
            'siteurl'
        )->pluck(
            'value'
        );
    }

}
