<?php
namespace app\controllers\super;

use app\controllers\base;
use app\models\entrust;
use View;
use Input;
use Redirect;
use Validator;

/**
 * Class RoleController
 *
 * @extends base\BaseController
 * @package app\controllers\super
 */
class RoleController extends base\BaseController
{
    /**
     * @access public
     *
     * GET a list of roles show in grid data table.
     *
     * @return Response HTML view of 'super.roles.index'
     */
    public function index()
    {
        $roles = entrust\Role::all();

        return View::make(
            'super.roles.index',
            compact(
                'roles'
            )
        );
    }

    /**
     * @access public
     *
     * 'GET' form for creating new role
     *
     * @return Response HTML partial view of 'super.roles._create'
     */
    public function create()
    {
        return View::make(
            'super.roles._create'
        );
    }

    /**
     * @access public
     *
     * POST data are verified by laravel validator class
     *
     * Failed validator is redirect back to with flash message
     *
     * Data are being stored inside database table 'roles'
     *
     * @return Redirect to action 'RoleController@index' with flash message
     */
    public function store()
    {
        $data = Input::all();

        $rules = array(
            'title' => 'required',
            'type' => 'required'
        );

        $validator = Validator::make(
            $data,
            $rules
        );

        if ($validator->fails()) {

            return Redirect::to(
                '/~super/roles'
            )->with(
                'error',
                'Sorry!!, Your request has not been acceptable.'
            );
        }

        $role = new entrust\Role();
        $role->name = strtolower(trim(Input::get('title')));
        $role->type = trim(Input::get('type'));

        try {
            $role->save();
        } catch (\Exception $e) {

            return Redirect::back()->with(
                'error',
                $role->title .' role is already exist, please try another email or user name !!'
            );
        }

        return Redirect::to(
            '/~super/roles'
        )->with(
            'success',
            'Your request has been submitted.'
        );
    }

}
