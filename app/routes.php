<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//<editor-fold desc="PART : SUPER">
Route::group(['namespace' => 'app\controllers\super'], function()
{
    //<editor-fold desc="PART : SUPER Login, Home and Error">
    Route::get(
        '/~super/login',
        'LoginController@getLogin'
    );

    Route::post(
        '/~super/login',
        'LoginController@postLogin'
    );

    Route::get(
        '/~super/logout',
        array(
            'before' => 'auth',
            'uses' => 'LoginController@logout'
        )
    );

    Route::get(
        '/~super/',
        array(
            'before' => 'auth',
            'uses' => 'HomeController@index'
        )
    );

    Route::get(
        '/~super/error',
        array(
            'before' => 'auth',
            'uses' => 'HomeController@error'
        )
    );
    //</editor-fold desc="PART : SUPER Login, Home and Error">

    //<editor-fold desc="PART : CMS Configuration Options">
    Route::get(
        '/~super/configs',
        array(
            'before' => 'auth',
            'uses' => 'ConfigurationController@index'
        )
    );

    Route::get(
        '/~super/configs/update',
        array(
            'before' => 'auth',
            'uses' => 'ConfigurationController@update'
        )
    );

    Route::post(
        '/~super/configs/update/{part}',
        array(
            'before' => 'auth',
            'uses' => 'ConfigurationController@imgUpdate'
        )
    );
    //</editor-fold desc="PART : CMS Configuration Options">

    //<editor-fold desc="PART : CSS Code Editor">
    Route::get(
        '/~super/code',
        array(
            'before' => 'auth',
            'uses' => 'CodeEditController@index'
        )
    );

    Route::post(
        '/~super/code',
        array(
            'before' => 'auth',
            'uses' => 'CodeEditController@update'
        )
    );
    //</editor-fold desc="PART : CSS Code Editor">

    //<editor-fold desc="PART : Roles">
    Route::get(
        '/~super/roles',
        array(
            'before' => 'auth',
            'uses' => 'RoleController@index'
        )
    );

    Route::get(
        '/~super/roles/create',
        array(
            'before' => 'auth',
            'uses' => 'RoleController@create'
        )
    );

    Route::post(
        '/~super/roles/create',
        array(
            'before' => 'auth',
            'uses' => 'RoleController@store'
        )
    );
    //</editor-fold desc="PART : Roles">

    //<editor-fold desc="PART : Users">
    Route::get(
        '/~super/users',
        array(
            'before' => 'auth',
            'uses' => 'UserController@index'
        )
    );

    Route::get(
        '/~super/users/create',
        array(
            'before' => 'auth',
            'uses' => 'UserController@create'
        )
    );

    Route::get(
        '/~super/users/roles',
        array(
            'before' => 'auth',
            'uses' => 'UserController@rolesList'
        )
    );

    Route::post(
        '/~super/users/create',
        array(
            'before' => 'auth',
            'uses' => 'UserController@store'
        )
    );
    //</editor-fold desc="PART : Roles">

    //<editor-fold desc="PART : Pages">
    Route::get(
        '/~super/pages',
        array(
            'before' => 'auth',
            'uses' => 'PageController@index'
        )
    );

    Route::get(
        '/~super/pages/create',
        array(
            'before' => 'auth',
            'uses' => 'PageController@create'
        )
    );

    Route::post(
        '/~super/pages/create',
        array(
            'before' => 'auth',
            'uses' => 'PageController@store'
        )
    );

    Route::get(
        '/~super/pages/{pId}',
        array(
            'before' => 'auth',
            'uses' => 'PageController@details'
        )
    )->where(['pId' => '[0-9]+']);

    Route::post(
        '/~super/pages/update/{pId}/content/{part}',
        array(
            'before' => 'auth',
            'uses' => 'PageController@contentUpdate'
        )
    )->where(['pId' => '[0-9]+', 'part' => '[a-z-A-Z]+']);
    //</editor-fold desc="PART : Pages">

    //<editor-fold desc="PART : Sections">
    Route::get(
        '/~super/pages/sections',
        array(
            'before' => 'auth',
            'uses' => 'SectionController@index'
        )
    );

    Route::get(
        '/~super/pages/sections/create',
        array(
            'before' => 'auth',
            'uses' => 'SectionController@create'
        )
    );

    Route::post(
        '/~super/pages/sections/create',
        array(
            'before' => 'auth',
            'uses' => 'SectionController@store'
        )
    );

    Route::get(
        '/~super/pages/sections/{id}',
        array(
            'before' => 'auth',
            'uses' => 'SectionController@details'
        )
    );

    Route::post(
        '/~super/pages/sections/update/{secId}/{part}',
        array(
            'before' => 'auth',
            'uses' => 'SectionController@update'
        )
    )->where(['secId' => '[0-9]+', 'part' => '[a-z]+']);

    Route::post(
        '/~super/pages/sections/update/{secId}/content/{part}',
        array(
            'before' => 'auth',
            'uses' => 'SectionController@contentUpdate'
        )
    )->where(['secId' => '[0-9]+', 'part' => '[a-z]+']);
    //</editor-fold desc="PART : Sections">

    //<editor-fold desc="PART : Section's items">
    Route::get(
        '/~super/pages/items/{id}',
        array(
            'before' => 'auth',
            'uses' => 'ItemController@details'
        )
    );

    Route::post(
        '/~super/pages/items/update/{itemId}/content/{part}',
        array(
            'before' => 'auth',
            'uses' => 'ItemController@contentUpdate'
        )
    )->where(['itemId' => '[0-9]+', 'part' => '[a-z]+']);
    //</editor-fold desc="PART : Section's items">

    //<editor-fold desc="PART : Menu">
    Route::get(
        '/~super/pages/menu',
        array(
            'before' => 'auth',
            'uses' => 'MenuController@index'
        )
    );

    Route::get(
        '/~super/pages/menu/create',
        array(
            'before' => 'auth',
            'uses' => 'MenuController@create'
        )
    );

    Route::post(
        '/~super/pages/menu/create',
        array(
            'before' => 'auth',
            'uses' => 'MenuController@store'
        )
    );
    //</editor-fold desc="PART : Menu">

});
//</editor-fold>

//<editor-fold desc="PART : CORE or ADMIN">
Route::group(['namespace' => 'app\controllers\core'], function()
{
    //<editor-fold desc="PART : CORE Login, home and error">
    Route::get(
        '/core/login',
        'LoginController@getLogin'
    );

    Route::post(
        '/core/login',
        'LoginController@postLogin'
    );

    Route::get(
        '/core/logout',
        array(
            'before' => 'auth',
            'uses' => 'LoginController@logout'
        )
    );

    Route::get(
        '/core/',
        array(
            'before' => 'auth',
            'uses' => 'HomeController@index'
        )
    );

    Route::get(
        '/core/error',
        array(
            'before' => 'auth',
            'uses' => 'HomeController@error'
        )
    );
    //</editor-fold>

    //<editor-fold desc="PART : CORE Administration">
    Route::get(
        '/core/profile', // logged in user's profile
        array(
            'before' => 'auth',
            'uses' => 'UserController@profile'
        )
    );

    Route::get(
        '/core/profile/{userId}', // select user's profile
        array(
            'before' => 'auth',
            'uses' => 'UserController@userProfile'
        )
    )->where(['userId' => '[0-9]+']);

    Route::get(
        '/core/password',
        array(
            'before' => 'auth',
            'uses' => 'UserController@getPassChange'
        )
    );

    Route::post(
        '/core/password',
        array(
            'before' => 'auth',
            'uses' => 'UserController@postPassChange'
        )
    );

    Route::get(
        '/core/users',
        array(
            'before' => 'auth',
            'uses' => 'UserController@index'
        )
    );

    Route::get(
        '/core/users/create',
        array(
            'before' => 'auth',
            'uses' => 'UserController@create'
        )
    );

    Route::get(
        '/core/users/roles',
        array(
            'before' => 'auth',
            'uses' => 'UserController@rolesList'
        )
    );

    Route::post(
        '/core/users/create',
        array(
            'before' => 'auth',
            'uses' => 'UserController@store'
        )
    );

    Route::post(
        '/core/users/update/{userId}/{part}',
        array(
            'before' => 'auth',
            'uses' => 'UserController@update'
        )
    )->where(['userId' => '[0-9]+', 'part' => '[a-z]+']);
    //</editor-fold">

    //<editor-fold desc="PART : CMS Configuration Options">
    Route::get(
        '/core/configs',
        array(
            'before' => 'auth',
            'uses' => 'ConfigurationController@index'
        )
    );

    Route::get(
        '/core/configs/update',
        array(
            'before' => 'auth',
            'uses' => 'ConfigurationController@update'
        )
    );

    Route::post(
        '/core/configs/update/{part}',
        array(
            'before' => 'auth',
            'uses' => 'ConfigurationController@imgUpdate'
        )
    );
    //</editor-fold desc="PART : CMS Configuration Options">

    //<editor-fold desc="PART : CSS Code Editor">
    Route::get(
        '/core/code',
        array(
            'before' => 'auth',
            'uses' => 'CodeEditController@index'
        )
    );

    Route::post(
        '/core/code',
        array(
            'before' => 'auth',
            'uses' => 'CodeEditController@update'
        )
    );
    //</editor-fold desc="PART : CSS Code Editor">

    //<editor-fold desc="PART : Pages Settings">
    Route::get(
        '/core/pages',
        array(
            'before' => 'auth',
            'uses' => 'PagesController@index'
        )
    );

    Route::get(
        '/core/pages/{id}',
        array(
            'before' => 'auth',
            'uses' => 'PagesController@page'
        )
    )->where(['id' => '[0-9]+']);

    Route::post(
        '/core/pages/update/{pId}/content/{part}',
        array(
            'before' => 'auth',
            'uses' => 'PagesController@contentUpdate'
        )
    )->where(['pId' => '[0-9]+', 'part' => '[a-z-A-Z]+']);

    Route::get(
        '/core/pages/{pageId}/{secId}/{itemId}/{contentType}',
        array(
            'before' => 'auth',
            'uses' => 'PagesController@sectionItem'
        )
    )->where(['pageId' => '[0-9]+', 'secId' => '[0-9]+', 'itemId' => '[0-9]+', 'contentType' => '[a-z-A-Z]+']);
    //</editor-fold desc="PART : Pages Settings">

    //<editor-fold desc="PART : Footer Widget">
    Route::get(
        '/core/widget',
        array(
            'before' => 'auth',
            'uses' => 'WidgetController@index'
        )
    );

    Route::post(
        '/core/widget',
        array(
            'before' => 'auth',
            'uses' => 'WidgetController@update'
        )
    );
    //</editor-fold desc="PART : Footer Widget">

    //<editor-fold desc="PART : Sections">
    Route::post(
        '/core/pages/sections/update/{secId}/{part}',
        array(
            'before' => 'auth',
            'uses' => 'PagesController@secUpdate'
        )
    )->where(['secId' => '[0-9]+', 'part' => '[a-z]+']);
    //</editor-fold desc="PART : Sections">

    //<editor-fold desc="PART : Section's items updated">
    Route::post(
        '/core/pages/items/update/{itemId}/content/{part}',
        array(
            'before' => 'auth',
            'uses' => 'ItemController@contentUpdate'
        )
    )->where(['itemId' => '[0-9]+', 'part' => '[a-z]+']);
    //</editor-fold desc="PART : Section's items updated">

    //<editor-fold desc="PART : Media gallery">
    Route::get(
        '/core/media',
        array(
            'before' => 'auth',
            'uses' => 'MediaController@index'
        )
    );

    Route::get(
        '/core/media/create',
        array(
            'before' => 'auth',
            'uses' => 'MediaController@create'
        )
    );

    Route::post(
        '/core/media/create',
        array(
            'before' => 'auth',
            'uses' => 'MediaController@store'
        )
    );

    Route::get(
        '/core/media/delete/{mediaId}',
        array(
            'before' => 'auth',
            'uses' => 'MediaController@delete'
        )
    )->where(['mediaId' => '[0-9]+']);
    //</editor-fold desc="PART : Media gallery">

    //<editor-fold desc="PART : Slider">
    Route::get(
        '/core/pages/slider/create/{pageId}/{secId}/{itemId}',
        array(
            'before' => 'auth',
            'uses' => 'SliderController@create'
        )
    )->where(['pageId' => '[0-9]+', 'secId' => '[0-9]+', 'itemId' => '[0-9]+']);

    Route::post(
        '/core/pages/slider/create',
        array(
            'before' => 'auth',
            'uses' => 'SliderController@store'
        )
    );

    Route::get(
        '/core/pages/slider/details/{pageId}/{secId}/{itemId}/{slideId}',
        array(
            'before' => 'auth',
            'uses' => 'SliderController@details'
        )
    )->where(['pageId' => '[0-9]+', 'secId' => '[0-9]+', 'itemId' => '[0-9]+','slideId' => '[0-9]+']);

    Route::post(
        '/core/pages/slider/update/{slideId}/{part}',
        array(
            'before' => 'auth',
            'uses' => 'SliderController@update'
        )
    )->where(['slideId' => '[0-9]+', 'part' => '[a-z]+']);

    Route::post(
        '/core/pages/slider/update/{slideId}/content/{part}',
        array(
            'before' => 'auth',
            'uses' => 'SliderController@contentUpdate'
        )
    )->where(['slideId' => '[0-9]+', 'part' => '[a-z]+']);
    //</editor-fold desc="PART : Slider">

    //<editor-fold desc="PART : Post">
    Route::post(
        '/core/pages/post/create',
        array(
            'before' => 'auth',
            'uses' => 'PostController@store'
        )
    );
    //</editor-fold desc="PART : Post">

    //<editor-fold desc="PART : News">
    Route::get(
        '/core/pages/news/create/{pageId}/{secId}/{itemId}',
        array(
            'before' => 'auth',
            'uses' => 'NewsController@create'
        )
    )->where(['pageId' => '[0-9]+', 'secId' => '[0-9]+', 'itemId' => '[0-9]+']);

    Route::post(
        '/core/pages/news/create',
        array(
            'before' => 'auth',
            'uses' => 'NewsController@store'
        )
    );

    Route::get(
        '/core/pages/news/details/{pageId}/{secId}/{itemId}/{newsId}',
        array(
            'before' => 'auth',
            'uses' => 'NewsController@details'
        )
    )->where(['pageId' => '[0-9]+', 'secId' => '[0-9]+', 'itemId' => '[0-9]+','newsId' => '[0-9]+']);

    Route::post(
        '/core/pages/news/update/{newsId}/{part}',
        array(
            'before' => 'auth',
            'uses' => 'NewsController@update'
        )
    )->where(['newsId' => '[0-9]+', 'part' => '[a-z]+']);
    //</editor-fold desc="PART : News">

    //<editor-fold desc="PART : Gallery">
    Route::get(
        '/core/pages/gallery/create/{pageId}/{secId}/{itemId}',
        array(
            'before' => 'auth',
            'uses' => 'GalleryController@create'
        )
    )->where(['pageId' => '[0-9]+', 'secId' => '[0-9]+', 'itemId' => '[0-9]+']);

    Route::post(
        '/core/pages/gallery/create',
        array(
            'before' => 'auth',
            'uses' => 'GalleryController@store'
        )
    );

    Route::get(
        '/core/pages/gallery/details/{pageId}/{secId}/{itemId}/{gId}',
        array(
            'before' => 'auth',
            'uses' => 'GalleryController@details'
        )
    )->where(['pageId' => '[0-9]+', 'secId' => '[0-9]+', 'itemId' => '[0-9]+','gId' => '[0-9]+']);

    Route::post(
        '/core/pages/gallery/update/{gId}/{part}',
        array(
            'before' => 'auth',
            'uses' => 'GalleryController@update'
        )
    )->where(['gId' => '[0-9]+', 'part' => '[a-z]+']);

    Route::post(
        '/core/pages/gallery/update/{gId}/content/{part}',
        array(
            'before' => 'auth',
            'uses' => 'GalleryController@contentUpdate'
        )
    )->where(['gId' => '[0-9]+', 'part' => '[a-z]+']);
    //</editor-fold desc="PART : Gallery">

    //<editor-fold desc="PART : Profile Gallery">
    Route::get(
        '/core/pages/profile/create/{pageId}/{secId}/{itemId}',
        array(
            'before' => 'auth',
            'uses' => 'ProfileGalleryController@create'
        )
    )->where(['pageId' => '[0-9]+', 'secId' => '[0-9]+', 'itemId' => '[0-9]+']);

    Route::post(
        '/core/pages/profile/create',
        array(
            'before' => 'auth',
            'uses' => 'ProfileGalleryController@store'
        )
    );

    Route::get(
        '/core/pages/profile/details/{pageId}/{secId}/{itemId}/{pId}',
        array(
            'before' => 'auth',
            'uses' => 'ProfileGalleryController@details'
        )
    )->where(['pageId' => '[0-9]+', 'secId' => '[0-9]+', 'itemId' => '[0-9]+','pId' => '[0-9]+']);

    Route::post(
        '/core/pages/profile/update/{pId}/{part}',
        array(
            'before' => 'auth',
            'uses' => 'ProfileGalleryController@update'
        )
    )->where(['pId' => '[0-9]+', 'part' => '[a-z]+']);

    Route::post(
        '/core/pages/profile/update/{pId}/content/{part}',
        array(
            'before' => 'auth',
            'uses' => 'ProfileGalleryController@contentUpdate'
        )
    )->where(['pId' => '[0-9]+', 'part' => '[a-z-A-Z]+']);
    //</editor-fold desc="PART : Profile Gallery">

    //<editor-fold desc="PART : Banner">
    Route::get(
        '/core/pages/banner/create/{pageId}/{secId}/{itemId}',
        array(
            'before' => 'auth',
            'uses' => 'BannerController@create'
        )
    )->where(['pageId' => '[0-9]+', 'secId' => '[0-9]+', 'itemId' => '[0-9]+']);

    Route::post(
        '/core/pages/banner/create',
        array(
            'before' => 'auth',
            'uses' => 'BannerController@store'
        )
    );

    Route::get(
        '/core/pages/banner/details/{pageId}/{secId}/{itemId}/{bId}',
        array(
            'before' => 'auth',
            'uses' => 'BannerController@details'
        )
    )->where(['pageId' => '[0-9]+', 'secId' => '[0-9]+', 'itemId' => '[0-9]+','bId' => '[0-9]+']);

    Route::post(
        '/core/pages/banner/update/{bId}/{part}',
        array(
            'before' => 'auth',
            'uses' => 'BannerController@update'
        )
    )->where(['bId' => '[0-9]+', 'part' => '[a-z]+']);

    Route::post(
        '/core/pages/banner/update/{bId}/content/{part}',
        array(
            'before' => 'auth',
            'uses' => 'BannerController@contentUpdate'
        )
    )->where(['bId' => '[0-9]+', 'part' => '[a-z-A-Z]+']);
    //</editor-fold desc="PART : Banner">

    //<editor-fold desc="PART : cForm">
    Route::post(
        '/core/pages/cform/create',
        array(
            'before' => 'auth',
            'uses' => 'cFormController@store'
        )
    );
    //</editor-fold desc="PART : cForm">

    //<editor-fold desc="PART : Entrepreneur Zone">
    Route::get(
        '/core/questions',
        array(
            'before' => 'auth',
            'uses' => 'QuestionController@index'
        )
    );

    Route::get(
        '/core/questions/create',
        array(
            'before' => 'auth',
            'uses' => 'QuestionController@create'
        )
    );

    Route::post(
        '/core/questions/create',
        array(
            'before' => 'auth',
            'uses' => 'QuestionController@store'
        )
    );

    Route::get(
        '/core/questions/{qId}',
        array(
            'before' => 'auth',
            'uses' => 'QuestionController@details'
        )
    )->where(['qId' => '[0-9]+']);

    Route::post(
        '/core/questions/update/{qId}/{part}',
        array(
            'before' => 'auth',
            'uses' => 'QuestionController@update'
        )
    )->where(['qId' => '[0-9]+', 'part' => '[a-z]+']);

    Route::get(
        '/core/questions/log',
        array(
            'before' => 'auth',
            'uses' => 'QuestionController@logs'
        )
    );

    Route::get(
        '/core/ideas',
        array(
            'before' => 'auth',
            'uses' => 'EntrepreneurController@index'
        )
    );

    Route::get(
        '/core/ideas/{id}',
        array(
            'before' => 'auth',
            'uses' => 'EntrepreneurController@details'
        )
    )->where(['id' => '[0-9]+']);

    Route::post(
        '/core/ideas/update/{id}',
        array(
            'before' => 'auth',
            'uses' => 'EntrepreneurController@updateStatus'
        )
    )->where(['id' => '[0-9]+']);

    Route::get(
        '/core/ideas/user/{userId}',
        array(
            'before' => 'auth',
            'uses' => 'EntrepreneurController@total'
        )
    )->where(['userId' => '[0-9]+']);

    Route::get(
        '/core/ideas/log',
        array(
            'before' => 'auth',
            'uses' => 'EntrepreneurController@logs'
        )
    );
    //</editor-fold desc="PART : Entrepreneur Zone" /core/ideas/log>
});
//</editor-fold>

//<editor-fold desc="PART : WEBSITE">
Route::group(['namespace' => 'app\controllers\web'], function()
{
    //<editor-fold desc="PART : Home, profile gallery">
    Route::get(
        '/',
        'HomeController@index'
    );

    Route::post(
        '/contact',
        'HomeController@contact'
    );

    Route::get(
        '/error',
        'HomeController@error'
    );

    Route::get(
        '/msg',
        'HomeController@msg'
    );

    Route::get(
        '/profile/{id}',
        'HomeController@profile'
    )->where(['id' => '[0-9]+']);

    Route::get(
        '/news/',
        'NewsController@index'
    );

    Route::get(
        '/news/{id}',
        'NewsController@news'
    )->where(['id' => '[0-9]+']);
    //</editor-fold desc="PART : Home, profile">

    //<editor-fold desc="PART : User Registration, email verification forgotten password">
    Route::get(
        '/registration',
        'RegistrationController@create'
    );

    Route::post(
        '/registration',
        'RegistrationController@store'
    );

    Route::get(
        '/verified',
        'RegistrationController@codeVerified'
    );

    Route::post(
        '/forgotten',
        'RegistrationController@forgotten'
    );

    Route::get(
        '/change',
        'RegistrationController@getChangePass'
    );

    Route::post(
        '/change',
        'RegistrationController@postChangePass'
    );
    //</editor-fold desc="PART : Profile Gallery">

    //<editor-fold desc="PART : User Login">
    Route::get(
        '/login',
        'LoginController@getLogin'
    );

    Route::post(
        '/login',
        'LoginController@postLogin'
    );

    Route::get(
        '/user/logout',
        array(
            'before' => 'auth',
            'uses' => 'LoginController@logout'
        )
    );
    //</editor-fold desc="PART : User Login">

    //<editor-fold desc="PART : Dashboard, password change">
    Route::get(
        '/user/',
        array(
            'before' => 'auth',
            'uses' => 'DashboardController@index'
        )
    );

    Route::get(
        '/user/warning',
        array(
            'before' => 'auth',
            'uses' => 'DashboardController@warning'
        )
    );

    Route::get(
        '/user/dashboard',
        array(
            'before' => 'auth',
            'uses' => 'DashboardController@index'
        )
    );

    Route::get(
        '/user/profile',
        array(
            'before' => 'auth',
            'uses' => 'DashboardController@profile'
        )
    );

    Route::post(
        '/user/profile/{part}',
        array(
            'before' => 'auth',
            'uses' => 'DashboardController@update'
        )
    )->where(['part' => '[a-z]+']);

    Route::get(
        '/user/password',
        array(
            'before' => 'auth',
            'uses' => 'DashboardController@getPassChange'
        )
    );

    Route::post(
        '/user/password',
        array(
            'before' => 'auth',
            'uses' => 'DashboardController@postPassChange'
        )
    );

    Route::get(
        '/user/idea',
        array(
            'before' => 'auth',
            'uses' => 'IdeaController@create'
        )
    );

    Route::post(
        '/user/idea',
        array(
            'before' => 'auth',
            'uses' => 'IdeaController@store'
        )
    );

    Route::get(
        '/user/idea/{ideaUserId}',
        array(
            'before' => 'auth',
            'uses' => 'IdeaController@details'
        )
    )->where(['ideaUserId' => '[0-9]+']);

    Route::get(
        '/user/idea/{ideaUserId}/download/{ideaUserAnsId}',
        array(
            'before' => 'auth',
            'uses' => 'IdeaController@download'
        )
    )->where(['ideaUserId' => '[0-9]+', 'ideaUserAnsId' => '[0-9]+']);
    //<editor-fold desc="PART : Dashboard">

    Route::get(
        '/{name}',
        'HomeController@part'
    );
});
//</editor-fold>