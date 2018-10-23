<?php
namespace app\models\core;

use Eloquent;

/**
 * Class CoreQuestion
 *
 * @extends Eloquent
 * @package app\models\core
 */
class CoreQuestion extends Eloquent
{
    /**
     * id, question, format, status, order_no,
     * uploaded_by, uploaded_date, modified_by, modified_date
     *
     * format = txt: textarea, file: attachment only pdf
     * status = 1:live, 0: deleted
     */

    /**
     * @access protected
     *
     * @var string should contain a database table name
     */
    protected $table = 'core_questions';

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
    protected $fillable = ['question', 'format', 'status', 'order_no', 'modified_by', 'modified_date'];

}
