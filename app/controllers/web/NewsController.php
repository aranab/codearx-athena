<?php
namespace app\controllers\web;

use app\controllers\base as web;
use app\models\core;
use app\models\super;
use View;
use Session;

/**
 * Class NewsController
 * @extend web\WebBaseController
 * @package app\controllers\web
 */
class NewsController extends web\WebBaseController
{
    /**
     * @access public
     *
     *
     * @return html page
     */
    public function index()
    {
        $newses = core\CorePage::where(
            'type',
            'content'
        )->where(
            'content_type',
            'news'
        )->orderBy(
            'id',
            'desc'
        )->get();

        $widget = core\CorePage::where(
            'type',
            'widget'
        )->where(
            'content_type',
            'post'
        )->first();

        return View::make(
            'web.news.index',
            compact(
                'newses',
                'widget'
            )
        );
    }

    /**
     * @access public
     *
     * @param int $id of the profile
     * @return html page
     */
    public function news($id)
    {
        if (!$id) {

            $msg = "Page is not found. please contact to administrator!!";
            return \Redirect::to(
                '/error'
            )->with(
                'error',
                $msg
            );
        }

        $news = core\CorePage::with(
            'newsDetails'
        )->where(
            'type',
            'content'
        )->where(
            'content_type',
            'news'
        )->where(
            'id',
            $id
        )->orderBy(
            'id',
            'desc'
        )->first();

        if (!$news) {

            $msg = "Page is not found. please try again with valid query, thank you!!";
            return \Redirect::to(
                '/error'
            )->with(
                'error',
                $msg
            );
        }

        $widget = core\CorePage::where(
            'type',
            'widget'
        )->where(
            'content_type',
            'post'
        )->first();

        return View::make(
            'web.news.news',
            compact(
                'news',
                'widget'
            )
        );
    }

}
