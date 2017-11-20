<?php
Route::get('/', 'User\UserController@news')->name('root');

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => '/hacker'], function () {
        Route::get('/', 'User\UserController@index')->name('home');
        Route::get('/scoreboard', function () {
            return view('user.scoreboard');
        })->name('scoreUsers');
    });

    Route::group(['prefix' => '/challs'], function () {
        Route::get('/', 'Challs\ChallengesController@userView')->name('challs');
        Route::post('/submit', 'Challs\ChallengesController@submitFlag');
    });

    Route::group(['prefix'=>"/".getenv('ADMIN_ROUTE', true)], function (){
        Route::get('/', 'AdminController@index')->name('admin');

        Route::group(['prefix' => '/challs'], function () {
            Route::get('/', 'Challs\ChallengesController@adminView')->name('adminChall');
            Route::get('/adicionar', 'Challs\ChallengesController@adminCreateView')->name('createChall');
            Route::post('/adicionar', 'Challs\ChallengesController@createFlag');
            Route::post('/deletar/{nome}/{id}', 'Challs\ChallengesController@delete');
            Route::post('/editar/{nome}/{id}', 'Challs\ChallengesController@update');
            Route::get('/editar/{nome}/{id}', 'Challs\ChallengesController@viewUpdate');
        });

        Route::group(['prefix' => '/categorias'], function () {
            Route::get('/', 'Challs\CategoryController@view')->name('categorias');
            Route::get('/adicionar', 'Challs\CategoryController@viewCreate')->name('categoriasViewCreate');
            Route::post('/adicionar', 'Challs\CategoryController@create')->name('categoriasCreate');
            Route::get('/editar/{nome}/{id}', 'Challs\CategoryController@viewUpdate');
            Route::post('/editar/{nome}/{id}', 'Challs\CategoryController@update');
            Route::post('/deletar/{nome}/{id}', 'Challs\CategoryController@delete');
        });

        Route::group(['prefix' => '/maestria'], function () {
            Route::get('/', 'User\MaestriaController@view')->name('maestrias');
            Route::post('/', 'User\MaestriaController@create')->name('maestriaCreate');
            Route::post('/editar/{nome}/{id}', 'User\MaestriaController@update')->name('maestriasUpdate');
            Route::post('/deletar/{nome}/{id}', 'User\MaestriaController@delete');
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
    Route::group(['prefix' => '/register'], function () {
        Route::get('/', ['as' => 'register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
        Route::post('/', ['as' => 'post-register', 'uses' => 'Auth\RegisterController@register']);
    });
});
