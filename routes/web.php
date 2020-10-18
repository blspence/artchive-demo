<?php

/*
|-------------------------------------------------------------------------------
| Web Routes
|-------------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Homepage Route
Route::get('/', 'ExhibitController@index')->name('exhibit.index'); // view all exhibits

/*
|-------------------------------------------------------------------------------
| Authentication Routes
|-------------------------------------------------------------------------------
*/
// Login/Logout Routes
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

/*
|-------------------------------------------------------------------------------
| FAQ Routes
|-------------------------------------------------------------------------------
*/
Route::get('/faq', 'FAQController@show')->name('faq.show');
Route::patch('/faq/{faq}', 'FAQController@update')->name('faq.update')->middleware('auth');
Route::get('/faq/{faq}/edit', 'FAQController@edit')->name('faq.edit')->middleware('auth');

/*
|-------------------------------------------------------------------------------
| Profile Routes
|-------------------------------------------------------------------------------
*/
Route::delete('/profile/{profile}', 'ProfileController@destroy')->name('profile.destroy')->middleware('auth');
Route::patch('/profile/{profile}', 'ProfileController@update')->name('profile.update')->middleware('auth');
Route::get('/profile/{profile}', 'ProfileController@show')->name('profile.show'); // PUBLIC PROFILE
Route::get('/profile/{profile}/edit', 'ProfileController@edit')->name('profile.edit')->middleware('auth');

/*
|-------------------------------------------------------------------------------
| User Routes (associated with 'auth' middleware in UserController)
|-------------------------------------------------------------------------------
*/
Route::get('/dashboard', 'UserController@dashboard')->name('dashboard');
Route::get('/user', 'UserController@index')->name('user.index');
Route::delete('/user/{user}', 'UserController@destroy')->name('user.destroy');
Route::patch('/user/{user}', 'UserController@update')->name('user.update');
Route::get('/user/{user}', 'UserController@show')->name('user.show');
Route::get('/user/{user}/edit', 'UserController@edit')->name('user.edit');

/*
|-------------------------------------------------------------------------------
| Submission Routes (associated with 'auth' middleware in SubmissionController)
|-------------------------------------------------------------------------------
*/
Route::post('/submission/{exhibit}', 'SubmissionController@store')->name('submission.store');
Route::get('/submission/admin/{exhibit}', 'SubmissionController@index')->name('submission.index'); // admin view all submissions for a particular exhibit page
Route::get('/submission/create/{exhibit}', 'SubmissionController@create')->name('submission.create');
Route::delete('/submission/{submission}', 'SubmissionController@destroy')->name('submission.destroy');
Route::patch('/submission/{submission}', 'SubmissionController@update')->name('submission.update');
Route::get('/submission/{submission}', 'SubmissionController@show')->name('submission.show');
Route::get('/submission/{submission}/edit', 'SubmissionController@edit')->name('submission.edit');
Route::get('/submission/{submission}/review', 'SubmissionController@review')->name('submission.review');
Route::patch('/submission/{submission}/review', 'SubmissionController@store_review')->name('submission.store_review');
Route::patch('/submission/{submission}/notify', 'SubmissionController@notify')->name('submission.notify');
Route::patch('/submission/all_notify/{exhibit}', 'SubmissionController@all_notify')->name('submission.all_notify'); //notify all applicants of their status
Route::post('/submission/admin/{exhibit}', 'SubmissionController@index')->name('submission.index');

/*
|-------------------------------------------------------------------------------
| Artwork Routes
|-------------------------------------------------------------------------------
*/
Route::get('/artwork', 'ArtworkController@index')->name('artwork.index'); // view all artworks
Route::get('/artwork/create', 'ArtworkController@create')->name('artwork.create')->middleware('auth'); // return a form to create a new artwork
Route::get('/artwork/{artwork}/show', 'ArtworkController@show')->name('artwork.show'); // get a specific artwork
Route::post('/artwork', 'ArtworkController@store')->name('artwork.store')->middleware('auth'); // handle post request to create a new artwork
Route::get('/artwork/{artwork}/edit', 'ArtworkController@edit')->name('artwork.edit')->middleware('auth'); // return a form to update a specific artwork
Route::patch('/artwork/{artwork}', 'ArtworkController@update')->name('artwork.update')->middleware('auth');// patch request to update an existing artwork
Route::delete('/artwork/{artwork}', 'ArtworkController@destroy')->name('artwork.destroy')->middleware('auth'); // delete a specific artwork

/*
|-------------------------------------------------------------------------------
| Exhibit Routes
|-------------------------------------------------------------------------------
*/
Route::get('/exhibit/create', 'ExhibitController@create')->name('exhibit.create')->middleware('auth'); // return user view to create a new exhibt
Route::get('/exhibit/{exhibit}', 'ExhibitController@show')->name('exhibit.show');
Route::post('/exhibit', 'ExhibitController@store')->name('exhibit.store')->middleware('auth'); // create a new exhibit
Route::get('/exhibit/{exhibit}/edit', 'ExhibitController@edit')->name('exhibit.edit')->middleware('auth'); //return a form to update an exhibit
Route::patch('/exhibit/{exhibit}', 'ExhibitController@update')->name('exhibit.update')->middleware('auth'); // patch request to update an exhibit
Route::delete('/exhibit/{exhibit}', 'ExhibitController@destroy')->name('exhibit.destroy')->middleware('auth'); // delete a specific exhibit
Route::get('/admin/exhibit', 'ExhibitController@adminIndex')->name('exhibit.adminIndex')->middleware('auth'); // admin view all exhibits

/*
|-------------------------------------------------------------------------------
| Archivist Routes
|-------------------------------------------------------------------------------
*/
Route::get('/archivist/upload/{exhibit}', 'ArchivistController@show')->name('archivist.show')->middleware('auth');// show all of the artworks from accepted submissions in an exhibit
Route::patch('/archivist/upload/{artwork}', 'ArchivistController@update')->name('archivist.update')->middleware('auth'); //route to update an artwork's public photo
Route::get('/archivist', 'ArchivistController@index')->name('archivist.index')->middleware('auth');//show all exhibits that the archivist can upload photos to
