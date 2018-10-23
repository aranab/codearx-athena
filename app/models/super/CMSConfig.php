<?php
namespace app\models\super;

use Eloquent;

/**
 * Class Config
 *
 * @extends Eloquent
 * @package app\models\super
 */
class CMSConfig extends Eloquent
{
    /**
     * id, name, value, autoload
     *
     * CMS configurations are loaded from this table
     * Configurations are :
     * 1. siteurl = all css, menu domain name get their domain from this site url
     * 2. home = for home page: site will be began to lunch from this url
     * 3. page_on_front = which page is being home or front page, here placed the page ID
     * 4. page_for_posts = which page is being post page, here placed the post ID (NEED TO DEVELOP)
     */

    /**
     * @access protected
     *
     * @var string should contain a database table name
     */
    protected $table = 'cms_configs';

    /**
     * @access public
     *
     * Is permitted to make 'create_at' and 'update_at' columns?
     *
     * @var bool Default true if it is not declared
     */
    public $timestamps = false;
}