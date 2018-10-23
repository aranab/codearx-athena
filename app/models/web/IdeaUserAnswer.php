<?php
namespace app\models\web;

use Eloquent;

/**
 * Class IdeaUserAnswer
 *
 * @extends Eloquent
 * @package app\models\web
 */
class IdeaUserAnswer extends Eloquent
{
    /**
     * id, idea_user_id, question_id, content, mime_type, guid, modified_date
     * idea_user_id = foreign key of 'idea_users' table's primary key
     * question_id = foreign key of 'core_questions' table's primary key
     * content = store answer of text base question
     * guid = url of attachment base question
     * modified_date = datetime when entrepreneur user edit the answer, here only entrepreneur user can edit but
     * only pending status
     */

    /**
     * @access protected
     *
     * @var string should contain a database table name
     */
    protected $table = 'idea_users_answers';

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
    protected $fillable = ['content'];

    /**
     * @access public
     *
     * Here return question
     *
     * Made ONE TO ONE relation with 'CoreQuestion' model
     *
     * by local key 'id' and foreign key 'question_id'
     *
     * @return mixed all column contain data from 'core_questions' table
     */
    public function question()
    {
        return $this->belongsTo(
            'app\models\core\CoreQuestion',
            'question_id',
            'id'
        );
    }

}
