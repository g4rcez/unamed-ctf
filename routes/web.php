<?php

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => getenv('USER_ROUTE', true)], function () {
        Route::get('/', 'User\UserController@index')->name('home');
        Route::get('/scoreboard', 'User\UserController@scoreboard')->name('scoreUsers');
        Route::get('/timeline', 'User\UserController@timeline')->name('timeline');
    });

    Route::group(['prefix' => getenv('TEAM_ROUTE', true)], function () {
        Route::get('/', 'User\TeamController@viewCreate')->name('createTeam');
        Route::get('/myTeam', 'User\TeamController@myTeam')->name('myTeam');
        Route::post('/', 'User\TeamController@createTeam')->name('createTeamPost');
        Route::post('/join', 'User\TeamController@associateTeam')->name('joinTeam');
    });

    Route::group(['prefix' => getenv('CHALLS_ROUTE', true)], function () {
        Route::get('/', 'Challs\ChallengesController@userView')->name('challs');
        Route::get('/search/{categoryId}', 'Challs\ChallengesController@userSearch');
        Route::post('/submit', 'Challs\ChallengesController@submitFlag');
        Route::post('/submitFlag', 'Challs\ChallengesController@submitFlagWithName');
    });
});

Route::group(['middleware' => ['auth', 'isAdmin']], function () {
    Route::group(['prefix' => getenv('ADMIN_ROUTE', true)], function () {
        Route::get('/', 'Admin\AdminController@index')->name('admin');

        Route::group(['prefix' => getenv('CHALLS_ROUTE', true)], function () {
            Route::get('/', 'Challs\ChallengesController@adminView')->name('adminChall');
            Route::get(getenv('CREATE_ROUTE'), 'Challs\ChallengesController@adminCreateView')->name('createChall');
            Route::post(getenv('CREATE_ROUTE'), 'Challs\ChallengesController@createFlag');
            Route::post(getenv('DELETE_ROUTE', true) . '/{id}', 'Challs\ChallengesController@delete');
            Route::post(getenv('EDIT_ROUTE') . '/{id}/{nome}', 'Challs\ChallengesController@update');
            Route::get(getenv('EDIT_ROUTE') . '/{id}', 'Challs\ChallengesController@viewUpdate');
        });

        Route::group(['prefix' => getenv('CATEGORIES_ROUTE')], function () {
            Route::get('/', 'Challs\CategoryController@view')->name('categorias');
            Route::get(getenv('CREATE_ROUTE'), 'Challs\CategoryController@viewCreate')->name('categoriasViewCreate');
            Route::post(getenv('CREATE_ROUTE'), 'Challs\CategoryController@create')->name('categoriasCreate');
            Route::get(getenv('EDIT_ROUTE') . '/{nome}/{id}', 'Challs\CategoryController@viewUpdate');
            Route::post(getenv('EDIT_ROUTE') . '/{nome}/{id}', 'Challs\CategoryController@update');
            Route::post(getenv('DELETE_ROUTE') . '/{nome}/{id}', 'Challs\CategoryController@delete');
        });
        Route::group(['prefix' => getenv('PERM_ROUTE', true)], function () {
            Route::get('/', 'Admin\PermissionController@view')->name('permissions');
            Route::post('/', 'Admin\PermissionController@create')->name('permissionCreate');
            Route::post(getenv('EDIT_ROUTE') . '{nome}/{id}', 'Admin\PermissionController@update')->name('permissionUpdate');
            Route::post(getenv('DELETE_ROUTE') . '{nome}/{id}', 'Admin\PermissionController@delete');
        });

        Route::group(['prefix' => getenv('MAESTRIAS_ROUTE', true)], function () {
            Route::get('/', 'User\MaestriaController@view')->name('maestrias');
            Route::post('/', 'User\MaestriaController@create')->name('maestriaCreate');
            Route::post('/editar/{nome}/{id}', 'User\MaestriaController@update')->name('maestriasUpdate');
            Route::post('/deletar/{nome}/{id}', 'User\MaestriaController@delete');
        });

        Route::group(['prefix' => getenv('NEWS_ROUTE')], function () {
            Route::get('/', 'NewsController@viewNews');
            Route::get(getenv('CREATE_ROUTE'), 'Admin\NewsController@viewCreate');
            Route::post(getenv('CREATE_ROUTE'), 'Admin\NewsController@create')->name("newsCreate");
        });

    });
});

Route::group(['prefix' => '/login'], function () {
    Route::get('/', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
    Route::post('/', ['as' => '', 'uses' => 'Auth\LoginController@login']);
});

Route::group(['prefix' => '/logout'], function () {
    Route::post('/', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
    Route::get('/', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
});

Route::group(['prefix' => '/senha'], function () {
    Route::post('email', ['as' => 'password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
    Route::get('/', ['as' => 'password.request', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
    Route::get('/recuperar', ['as' => 'password.request', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
    Route::post('reset', ['as' => '', 'uses' => 'Auth\ResetPasswordController@reset']);
    Route::get('reset/{token}', ['as' => 'password.reset', 'uses' => 'Auth\ResetPasswordController@showResetForm']);
});

Route::group(['middleware' => ['guest']], function () {
    Route::group(['prefix' => getenv("CTF_REGISTER", true)], function () {
        Route::get('/', ['as' => 'register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
        Route::post('/', ['as' => 'post-register', 'uses' => 'Auth\RegisterController@register']);
    });
});

Route::get('/', 'Admin\NewsController@viewNews')->name('root');
Route::get('/patrocinadores', 'NewsController@patrocinadores');
