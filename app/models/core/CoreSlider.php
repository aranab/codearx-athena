<?php
namespace app\models\core;

use Eloquent;

/**
 * Class CoreSlider
 *
 * @extends Eloquent
 * @package app\models\core
 */
class CoreSlider extends Eloquent
{
    /**
     * id, sec_id, name, title, description, pic_name, ext, path, order_no, status
     * uploaded_by, uploaded_date, modified_by, modified_date
     *
     */

    /**
     * @access protected
     *
     * @var string should contain a database table name
     */
    protected $table = 'core_sliders';

    /**
     * @access public
     *
     * Is permitted to make 'create_at' and 'update_at' columns?
     *
     * @var bool Default true if it is not declared
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'title', 'description', 'content', 'ext', 'order_no', 'status', 'modified_by', 'modified_date'];

}
