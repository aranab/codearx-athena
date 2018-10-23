<?php
namespace app\controllers\core;

use app\controllers\base;
use app\models\super;
use app\models\core;
use View;
use Input;
use Redirect;
use Validator;
use Response;
use Auth;
use File;

/**
 * Class ConfigurationController
 *
 * @extends base\CoreController
 * @package app\controllers\core
 */
class ConfigurationController extends base\CoreController
{
    /**
     * @access public
     *
     * @return Response HTML view of 'core.config.options'
     */
    public function index()
    {
        $configs = super\CMSConfig::all();

        return View::make(
            'core.config.options',
            compact(
                'configs'
            )
        );
    }

    /**
     * @access public
     *
     * Ajax GET request Update the CMS configuration 'cms_configs' table base on url parameters 'opt' and 'value'
     *
     * 'opt' and 'value' are for table's fields 'name' and 'value'
     *
     * @return Response JSON Data
     */
    public function update()
    {
        if (!($opt = trim(Input::get('opt'))) || !($val = trim(Input::get('value')))) {

            return Response::Json(
                array(
                    'status' => 'error',
                    'msg' => 'Some thing is wrong, please contact to administrator!!'
                )
            );
        }

        $query = super\CMSConfig::where(
            'name',
            $opt
        )->update(
            array(
                'value' => $val
            )
        );

        if (!$query) {

            return Response::Json(
                array(
                    'status' => 'error',
                    'msg' => 'Some thing is wrong, please contact to administrator!!'
                )
            );
        }

        return Response::Json(
            array(
                'status' => 'ok',
                'msg' => 'Configuration has been updated!!'
            )
        );
    }

    /**
     * @access public
     *
     * Ajax GET request Update the CMS configuration 'cms_configs' table
     *
     * Here $part either logo or favicon
     *
     * @param string $part name of image definition
     * @return Response JSON Data
     */
    public function imgUpdate($part)
    {
        if (!$part || Input::has('pic')) {

            return Response::Json(
                array(
                    'status' => 'error',
                    'msg' => 'Some thing is wrong, please contact to administrator!!'
                )
            );
        }

        $name = 'logo';
        if ($part == 'logo') {
            $part = 'site_logo';
            $name = 'logo';
        }

        if ($part == 'fav') {
            $part = 'site_favicon';
            $name = 'favicon';
        }

        $config = super\CMSConfig::where(
            'name',
            $part
        )->first();

        if (!$config) {

            return Response::Json(
                array(
                    'status' => 'error',
                    'msg' => 'Some thing is wrong, please contact to administrator!!'
                )
            );
        }

        try {
            File::Delete(public_path().$config->value);
        } catch (\Exception $e) {
            return Response::Json(
                array(
                    'status' => 'error',
                    'msg' => 'Some thing is wrong, please contact to administrator!!'
                )
            );
        }

        $pic = Input::file('pic');
        $query = 1;
        if (!($config->value == ($val = "/img/$name.".$pic->guessClientExtension()))) {
            $query = super\CMSConfig::where(
                'id',
                $config->id
            )->update(
                array(
                    'value' => $val
                )
            );
        }

        if (!$query) {

            return Response::Json(
                array(
                    'status' => 'error',
                    'msg' => 'Some thing is wrong, please contact to administrator!!'
                )
            );
        }

        $destinationPath = public_path().'/img/';
        $picName = "$name.".$pic->guessClientExtension();
        $pic->move(
            $destinationPath,
            $picName
        );

        return Response::Json(
            array(
                'status' => 'ok',
                'msg' => 'Change has been updated!!'
            )
        );
    }

}
