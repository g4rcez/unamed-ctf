<?php
Route::get('/', 'User\UserController@index')->name('root');

Route::group([ 'middleware' => ['auth'] ], function () {
    Route::group(['prefix' => '/home'], function () {
        Route::get('/', 'User\UserController@index')->name('home');
        Route::get('/scoreboard', function () {
            return view('user.scoreboard');
        })->name('scoreUsers');
    });
// Route::group([ 'middleware' => ['admin'] ], function () {
//   Route::get('/viewUser', 'Challs\Challenges@viewCreate')->name('viewChall');
//   Route::post('/adicionar', 'Challs\Challenges@create')->name('createChall');
// });
    Route::group(['prefix' => '/challs'], function () {
      Route::get('/', 'Challs\Challenges@userView')->name('challs');
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

Route::group([ 'middleware' => ['guest'] ], function () {
    Route::group(['prefix' => '/register'], function () {
        Route::get('/', ['as' => 'register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
        Route::post('/', ['as' => 'post-register', 'uses' => 'Auth\RegisterController@register']);
    });
});

Route::get('/scoreboard', function(){
  return view('guest.scoreboard');
})->name('scoreGuest');


Route::group(['prefix' => '/team'], function () {
  Route::get('/cadastrar', function(){
    return view('team.create');
  })->name('teamCreate');

  Route::get('/', function(){
    return view('team.index');
  })->name('teamIndex');
});
