<?php
namespace app\models\web;

use Eloquent;

/**
 * Class IdeaUser
 *
 * @extends Eloquent
 * @package app\models\web
 */
class IdeaUser extends Eloquent
{
    /**
     * id, user_id, status, remarks,
     * uploaded_by, uploaded_date, modified_by, modified_date
     * status = 0: Rejected(color: red), 1: Pending(color: blue), 2: Viewing(color: yellow), 3: Accepted(color:green)
     */

    /**
     * @access protected
     *
     * @var string should contain a database table name
     */
    protected $table = 'idea_users';

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
    protected $fillable = ['status', 'remarks', 'modified_date'];

    /**
     * @access public
     *
     * Here gets the user's all answers
     *
     * Made ONE TO MANY relation with 'IdeaUserAnswer' model
     *
     * by local key 'id' and foreign key 'idea_user_id'
     *
     * @return mixed all column contain data from 'idea_users_answers' table
     */
    public function answers()
    {
        return $this->hasMany(
            'app\models\web\IdeaUserAnswer',
            'idea_user_id',
            'id'
        )->orderBy(
            'id',
            'asc'
        );
    }

    /**
     * @access public
     *
     * Here return user information
     *
     * Made ONE TO ONE relation with 'CoreUser' model
     *
     * by local key 'id' and foreign key 'user_id'
     *
     * @return mixed all column contain data from 'core_users' table
     */
    public function user()
    {
        return $this->belongsTo(
            'app\models\core\CoreUser',
            'user_id',
            'id'
        );
    }

}
