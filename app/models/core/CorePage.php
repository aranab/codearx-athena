<?php
namespace app\models\core;

use Eloquent;

/**
 * Class CorePage
 *
 * @extends Eloquent
 * @package app\models\core
 */
class CorePage extends Eloquent
{
    /**
     * id, title, parent_id, name, content, type, content_type, status, section_order, menu_order, mine_type, guid,
     * uploaded_by, uploaded_date, modified_by, modified_date
     *
     * name = preg_replace('/\s+/', '-', 'title'); but only first 200 character
     * type = page, section, menu, item, content
     * content_type = slider, post, news, gallery, profile, link, banner, attachment, form
     * status = true or false, not null
     * section_order = default 0, not null
     * menu_order = default 0, not null
     * guid = depends on type, domainName/?{{type}}={{id}}
     */

    /**
     * @access protected
     *
     * @var string should contain a database table name
     */
    protected $table = 'core_pages';

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
    protected $fillable = ['title', 'content', 'status', 'section_order', 'menu_order', 'mine_type', 'guid', 'modified_by', 'modified_date'];

    /**
     * @access public
     *
     * Here gets the section's items list
     *
     * Made ONE TO MANY relation with 'CorePage' model, this is recursive method
     *
     * by local key 'id' and foreign key 'parent_id'
     *
     * @return mixed all column contain data from 'core_pages' table
     */
    public function items()
    {
        return $this->hasMany(
            self::class,
            'parent_id',
            'id'
        )->orderBy(
            'id',
            'asc'
        )->where(
            'type',
            'item'
        );
    }

    /**
     * @access public
     *
     * Here gets the selects of a page
     *
     * Made ONE TO MANY relation with 'CorePage' model, this is recursive method
     *
     * by local key 'id' and foreign key 'parent_id'
     *
     * @return mixed all column contain data from 'core_pages' table
     */
    public function sections()
    {
        return $this->hasMany(
            self::class,
            'parent_id',
            'id'
        )->orderBy(
            'section_order',
            'asc'
        )->where(
            'type',
            'section'
        );
    }

    /**
     * @access public
     *
     * Here gets the menu link of a page
     *
     * Made ONE TO MANY relation with 'CorePage' model, this is recursive method
     *
     * by local key 'id' and foreign key 'parent_id'
     *
     * @return mixed all column contain data from 'core_pages' table
     */
    public function menu()
    {
        return $this->hasMany(
            self::class,
            'parent_id',
            'id'
        )->orderBy(
            'menu_order',
            'asc'
        )->where(
            'type',
            'menu'
        );
    }

    /**
     * @access public
     *
     * Here gets the menu link of a page
     *
     * Made ONE TO ONE relation with 'CorePage' model, this is recursive method
     *
     * by local key 'parent_id' and parent key 'id'
     *
     * @return mixed all column contain data from 'core_pages' table
     */
    public function page()
    {
        return $this->belongsTo(
            self::class,
            'parent_id',
            'id'
        )->where(
            'type',
            'page'
        );
    }

    /**
     * @access public
     *
     * Here gets the menu link of a page
     *
     * Made ONE TO ONE relation with 'CorePage' model, this is recursive method
     *
     * by foreign key 'parent_id' and parent key 'id'
     *
     * @return mixed all column contain data from 'core_pages' table
     */
    public function newsDetails()
    {
        return $this->hasOne(
            self::class,
            'parent_id',
            'id'
        )->where(
            'type',
            'content'
        )->where(
            'content_type',
            'news-details'
        );
    }

}
