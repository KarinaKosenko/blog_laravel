<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/**
 * Routes for admin panel.
 */
Route::group(['namespace' => 'Admin', 'middleware' => 'admin', 'prefix' => 'admin'], function () {
	
	Route::get('/', 'ArticlesController@index')
		->name('admin.articles.index');

    /**
     * Routes for articles.
     */
	Route::group(['prefix' => '/articles'], function () {
		
		Route::get('/', 'ArticlesController@index')
			->name('admin.articles.index');
		
		Route::get('/one/{id}', 'ArticlesController@one')
			->name('admin.articles.one');
		
		Route::get('/add' ,'ArticlesController@add')
			->name('admin.articles.add');
			
		Route::post('/add' ,'ArticlesController@addPost')
			->name('admin.articles.addPost');
			
		Route::get('/edit/{id}', 'ArticlesController@edit')
			->name('admin.articles.edit');
			
		Route::post('/edit/{id}', 'ArticlesController@editPost')
			->name('admin.articles.editPost');
			
		Route::get('/delete/{id}', 'ArticlesController@delete')
			->name('admin.articles.delete');
	});

    /**
     * Routes for guest book messages.
     */
	Route::group(['prefix' => 'guestbook'], function () {
		
		Route::get('/', 'GuestbookController@index')
			->name('admin.guestbook.index');
		
		Route::get('/add', 'GuestbookController@add')
			->name('admin.guestbook.add');
			
		Route::post('/add', 'GuestbookController@addPost')
			->name('admin.guestbook.addPost');
			
		Route::get('/edit/{id}', 'GuestbookController@edit')
			->name('admin.guestbook.edit');
			
		Route::post('/edit/{id}', 'GuestbookController@editPost')
			->name('admin.guestbook.editPost');
			
		Route::get('/delete/{id}', 'GuestbookController@delete')
			->name('admin.guestbook.delete');
	});

    /**
     * Routes for comments.
     */
	Route::group(['prefix' => 'comments'], function () {
	
		Route::get('/add/{article_id}/{parent_id?}', 'CommentsController@add')
			->name('admin.comments.add');
			
		Route::post('/add/{article_id}/{parent_id?}', 'CommentsController@addPost')
			->name('admin.comments.addPost');
			
		Route::get('/edit/{article_id}/{comment_id}', 'CommentsController@edit')
			->name('admin.comments.edit');
			
		Route::post('/edit/{article_id}/{comment_id}', 'CommentsController@editPost')
			->name('admin.comments.editPost');
			
		Route::get('/delete/{article_id}/{comment_id}', 'CommentsController@delete')
			->name('admin.comments.delete');
	});
});


/**
 * Routes for the client side.
 */
Route::group(['namespace' => 'Client'], function () {
	
	Route::get('/', 'ArticlesController@index')
		->name('public.articles.index');

    /**
     * Routes for articles.
     */
	Route::group(['prefix' => 'articles'], function () {
		
		Route::get('/', 'ArticlesController@index')
			->name('public.articles.index');
			
		Route::get('/one/{id}', 'ArticlesController@one')
			->name('public.articles.one');
	});

    /**
     * Routes for guest book messages.
     */
	Route::group(['prefix' => 'guestbook'], function () {
		
		Route::get('/', 'GuestbookController@index')
			->name('public.guestbook.index');
		
		Route::get('/add', 'GuestbookController@add')
			->name('public.guestbook.add');
			
		Route::post('/add', 'GuestbookController@addPost')
			->name('public.guestbook.addPost');

        Route::group(['middleware' => 'auth'], function () {

            Route::get('/edit/{id}', 'GuestbookController@edit')
                ->name('public.guestbook.edit');

            Route::post('/edit/{id}', 'GuestbookController@editPost')
                ->name('public.guestbook.editPost');

            Route::get('/delete/{id}', 'GuestbookController@delete')
                ->name('public.guestbook.delete');
        });
	});

    /**
     * Routes for feedback.
     */
    Route::group(['prefix' => 'feedback'], function () {

        Route::get('/', 'FeedbackController@feedback')
            ->name('public.feedback.feedback');

        Route::post('/', 'FeedbackController@feedbackPost')
            ->name('public.feedback.feedbackPost');
    });

    /**
     * Routes for articles archive.
     */
	Route::group(['prefix' => 'archive'], function () {
	
		Route::get('/search', 'ArchivesController@search')
			->name('public.archives.search');
	});

    /**
     * Routes for comments.
     */
	Route::group(['prefix' => 'comments', 'middleware' => 'auth'], function () {
	
		Route::get('/add/{article_id}/{parent_id?}', 'CommentsController@add')
			->name('public.comments.add');
			
		Route::post('/add/{article_id}/{parent_id?}', 'CommentsController@addPost')
			->name('public.comments.addPost');

        Route::get('/edit/{article_id}/{comment_id}', 'CommentsController@edit')
            ->name('public.comments.edit');

        Route::post('/edit/{article_id}/{comment_id}', 'CommentsController@editPost')
            ->name('public.comments.editPost');

        Route::get('/delete/{article_id}/{comment_id}', 'CommentsController@delete')
            ->name('public.comments.delete');
	});
});


/**
 * Routes for authentication.
 */

/**
 * Routes for registration.
 */
Route::get('/register', 'AuthController@register')
    ->name('public.auth.register');
	
Route::post('/register', 'AuthController@registerPost')
    ->name('public.auth.registerPost');

/**
 * Routes for log in.
 */
Route::get('/login', 'AuthController@login')
    ->name('login');
	
Route::post('/login', 'AuthController@loginPost')
    ->name('public.auth.loginPost');
	
Route::get('/admin/login','AuthController@login')
    ->name('admin.auth.login');
	
Route::post('/admin/login', 'AuthController@loginAdminPost')
    ->name('admin.auth.loginPost');

/**
 * Route for log out.
 */
Route::get('/logout', 'AuthController@logout')
    ->name('public.auth.logout');


	