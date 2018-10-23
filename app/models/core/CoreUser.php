<?php
namespace app\models\core;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Zizaco\Entrust\HasRole;
use Eloquent;
use Config;

/**
 * Class CoreUser
 *
 * @extends Eloquent
 * @implements UserInterface
 * @implements RemindableInterface
 * @package app\models\core
 */
class CoreUser extends Eloquent implements
    UserInterface,
    RemindableInterface
{
	use UserTrait, RemindableTrait, HasRole;

    /**
     * id, fname, lname, username, email, password, mobile, address, pic_name, ext, path,
     * user_type, confirmed, confirmation_code, remember_token, password_reset_token, last_visit_ip, status,
     * uploaded_by, uploaded_date, modify_by, modify_date
     */

    /**
     * @access protected
     *
     * @var string should contain a database table name
     */
	protected $table = 'core_users';

    /**
     * @access public
     *
     * Is permitted to make 'create_at' and 'update_at' columns?
     *
     * @var bool Default true if it is not declared
     */
    public $timestamps = false;

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname',
        'lname',
        'mobile',
        'gender',
        'address',
        'ext',
        'confirmed',
        'confirmation_code',
        'password_reset_token',
        'pic_name',
        'last_visit_ip',
        'status'
    ];

    /**
     * @access public
     *
     * Made MANY TO MANY relation with 'Role' model and 'assigned_roles' table.
     *
     * Here 'Config::get' get the actual table from entrust configuration file.
     *
     * by foreign key 'user_id', relational table 'assigned_roles'
     *
     * and foreign key 'role_id' of 'assigned_roles'.
     *
     * @return all roles of a user
     */
    public function roles()
    {
        return $this->belongsToMany(
            'app\models\entrust\Role',
            Config::get(
                'entrust::assigned_roles_table'
            ),
            'user_id',
            'role_id'
        );
    }

    /**
     * @access public
     *
     * @return string full name of a user
     */
    public function fullName()
    {
        return $this->fname.' '. $this->lname;
    }

    /**
     * @access public
     *
     * Here gets the user's all ideas
     *
     * Made ONE TO MANY relation with 'IdeaUser' model
     *
     * by local key 'id' and foreign key 'user_id'
     *
     * @return mixed all column contain data from 'idea_users' table
     */
    public function ideas()
    {
        return $this->hasMany(
            'app\models\web\IdeaUser',
            'user_id',
            'id'
        )->orderBy(
            'id',
            'asc'
        );
    }

}
