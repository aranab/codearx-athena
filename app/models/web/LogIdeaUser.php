<?php
namespace app\models\web;

use Eloquent;

/**
 * Class LogIdeaUser
 *
 * @extends Eloquent
 * @package app\models\web
 */
class LogIdeaUser extends Eloquent
{
    /**
     * id, idea_user_id, status
     * uploaded_by, uploaded_date
     * status = 0: Rejected(color: red), 1: Pending(color: blue), 2: Viewing(color: yellow), 3: Accepted(color:green)
     */

    /**
     * @access protected
     *
     * @var string should contain a database table name
     */
    protected $table = 'log_idea_users';

    /**
     * @access public
     *
     * Is permitted to make 'create_at' and 'update_at' columns?
     *
     * @var bool Default true if it is not declared
     */
    public $timestamps = false;

}
