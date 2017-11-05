<?php
Route::get('/', 'User\UserController@index')->name('root');

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => '/home'], function () {
        Route::get('/', 'User\UserController@index')->name('home');
        Route::get('/scoreboard', function () {
            return view('user.scoreboard');
        })->name('scoreUsers');
    });
// Route::group([ 'middleware' => ['admin'] ], function () {
//   Route::get('/viewUser', 'Challs\ChallengesController@viewCreate')->name('viewChall');
//   Route::post('/adicionar', 'Challs\ChallengesController@create')->name('createChall');
// });
    Route::group(['prefix' => '/challs'], function () {
        Route::get('/', 'Challs\ChallengesController@userView')->name('challs');
    });

    Route::group(['prefix' => '/categorias'], function () {
        Route::get('/', 'Challs\CategoryController@view')->name('categorias');
        Route::get('/nova', 'Challs\CategoryController@viewCreate')->name('categoriasViewCreate');
        Route::post('/nova', 'Challs\CategoryController@create')->name('categoriasCreate');
        Route::get('/editar/{nome}/{id}', 'Challs\CategoryController@viewUpdate');
        Route::post('/editar/{nome}/{id}', 'Challs\CategoryController@update')->name('updateCategoria');
        Route::post('/deletar/{nome}/{id}', 'Challs\CategoryController@delete')->name('updateCategoria');
    });

    Route::group(['prefix' => '/maestria'], function () {
        Route::post('/', 'User\MaestriaController@create')->name('maestriaCreate');
        Route::get('/', 'User\MaestriaController@view')->name('maestrias');
        Route::get('/{id}', 'User\MaestriaController@update')->name('maestriasUpdate');
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