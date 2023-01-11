<?php

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

use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ContactController;

Auth::routes();
Route::post('/ckeditor/upload', 'CkeditorController@upload')->name('ckeditor.upload');

Route::get('/clear', function () {

    \Artisan::call('cache:clear');
    \Artisan::call('key:generate');
    \Artisan::call('config:cache');
    
    dd("artisan run successfully");

});

Route::get('/', 'HomeController@index');
Route::prefix('admin')->group(function () {

    Route::get('/', 'Auth\AdminLoginController@index');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('login.submit');
    Route::get('/change_profile', 'AdminController@change_profile')->name('admin.change_profile');
    Route::post('/change_profile', 'AdminController@update_profile')->name('admin.update_profile');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');

    Route::get('/navigation-list/{category}', 'Admin\NavigationController@index');
    Route::get('/navigation-list/{category}/create', 'Admin\NavigationController@create');


    //page type
    Route::resource('/pageType', 'Admin\PageTypeController');


    //photo gallery
    Route::get('/navigation-list/{category}/{id}/showList', 'Admin\NavigationController@showMediaList');
    Route::get('/navigation-list/{category}/{id}/showList/create', 'Admin\NavigationController@addMedia');
    Route::post('/navigation-list/{category}/{id}/addAlbum', 'Admin\NavigationController@storeAlbum');
    Route::get('/navigation-list/media/{id}/delete', 'Admin\NavigationController@deleteMedia');
    Route::post('/navigation-list/media/{id}/update', 'Admin\NavigationController@updateMedia');

    //video gallery
    Route::get('/navigation-list/{category}/{id}/vlink', 'Admin\VideoController@showVideoList');
    Route::get('/navigation-list/{category}/{id}/vlink/create', 'Admin\VideoController@addVideo');
    Route::post('/navigation-list/{category}/{id}/addVideoAlbum', 'Admin\VideoController@storeVideoAlbum');
    Route::post('/navigation-list/vlink/{id}/update', 'Admin\VideoController@updateLinks');
    Route::get('/navigation-list/vlink/{id}/delete', 'Admin\VideoController@deleteLink');
    Route::post('/navigation-list/{category}/{id?}', 'Admin\NavigationController@store');
    Route::get('/navigation-edit/{category}/{id}/edit', 'Admin\NavigationController@edit');
    Route::put('/navigation-edit/{category}/{id}', 'Admin\NavigationController@update');
    Route::get('/navigation-edit/{category}/{id}', 'Admin\NavigationController@deleteIconImage');
    Route::get('/navigation-edit/{category}/{id}/deleteimage2', 'Admin\NavigationController@deleteFeaturedImage');
    Route::get('/navigation-edit/{category}/{id}/deleteimage3', 'Admin\NavigationController@deleteBannerImage');
    Route::get('/navigation-edit/{category}/{id}/deletemainattachment', 'Admin\NavigationController@deletemainattachment');
    Route::get('/navigation-edit/{category}/{id}/deleteattachment', 'Admin\NavigationController@deleteattachment');
    Route::get('/navigation-list/{category}/{id}/delete', 'Admin\NavigationController@destroy');
    Route::get('/navigation-list/{category}/{id}', 'Admin\NavigationController@childNavigation')->where(['id' => '[0-9]+']);
    Route::get('/navigation-list/{category}/{id}/create', 'Admin\NavigationController@create')->where(['id' => '[0-9]+']);


    Route::get('/global-setting', 'Admin\GlobalSettingController@global_setting');
    //Route::post('/global-setting','Admin\GlobalSettingController@create')->name('create.global-setting');
    Route::post('/global_setting', 'Admin\GlobalSettingController@updateSettings')->name('update.global_setting');
    Route::get('/subscribers-list', 'Admin\SubscriberController@index');
    Route::get('/subscribers-list/{id}', 'Admin\SubscriberController@destroy');
    Route::put('/navigation-list/{id}', 'Admin\NavigationController@update_status')->name('update_status');

    // ............................. feedback.......................
    Route::get('/feedbacks-list', 'Admin\FeedbackController@index');
    Route::get('/feedbacks-view/{id}', 'Admin\FeedbackController@view');
    Route::get('/feedbacks-list/{id}', 'Admin\FeedbackController@destroy');
    Route::put('/feedbacks-list/{id}', 'Admin\FeedbackController@update_status')->name('update_status');

    // ............................. comment.......................

    Route::get('/{id}/comment_list', 'Admin\CommentController@index');
    Route::get('/{id}/comment-delete', 'Admin\CommentController@destroy');
    Route::get('/comment-status/{id}', 'Admin\CommentController@updatestatus');

    //................................customized my MD for Job.............
    Route::get('/contact/{slug}', [ContactController::class, 'Contactelete'])->name('contactDelete');
    Route::get('/job/{category}/{id}/create', 'JobController@AddJob')->name("AddJob");
    Route::get('/job/{category}/create', 'JobController@AddJob')->name("AddJob");
    Route::post('/jobstore/{category}', 'JobController@store')->name("AddJob1");
    Route::post('/jobstore/{category}/{id}', 'JobController@store')->name("AddJob2");
    Route::get('/jobedit/{category}/{id}', 'JobController@edit')->name("jobedit");
    Route::post('/jobupdate/{category}/{id}', 'JobController@JobUpdate');
    Route::get('/job/delete-banner-image/{category}/{id}/deleteimage3', 'JobController@deleteBannerImage')->name('deleteBannerImage');
    Route::get('/job-list', 'JobController@jobList')->name("joblist");
    Route::get('/applied-job-list', 'ContactController@AppliedJob')->name("AppliedJob");
});

Route::get('get_gallery_photos', [HomeController::class, 'get_gallery_photos'])->name('get_gallery_photos');
Route::get('gallery-view/{slug}', [HomeController::class, 'GalleryView'])->name('galleryview');
Route::get('inquiry', [ContactController::class, 'inquiry'])->name('inquiry');
Route::get('job-category', [HomeController::class, 'allCategory'])->name('allCategory');
Route::get('/all-jobs', [HomeController::class, 'allJobs'])->name('allJobs');
Route::get('read-more/{slug}', [HomeController::class, 'ReadMore'])->name('readmore');

Route::POST('jobapply/store/{slug}', [ContactController::class, 'ContactStore'])->name('storeapply');




Route::get('/detail/{jobslug}', [HomeController::class, 'singlePage'])->name('single_career');
Route::get('/all/{dateslug}', [HomeController::class, 'Alll_Month_Page'])->name('month_data');
Route::get('/all-data/{dataslug}', [HomeController::class, 'get_all_Acc_date'])->name('all-data');
Route::get('/all_data/{dataslug}', [HomeController::class, 'All_cat_data'])->name('all-data');

Route::get('/monthly_all/{dataslug}', [HomeController::class, 'get_all_Acc_Monthly'])->name('data_all');

Route::get('/team-details/{dataslug}', [HomeController::class, 'Team_details'])->name('team-details');


Route::get('/pdf/{dataslug}', [HomeController::class, 'pdf_details'])->name('pdf_details');
// 



// Team_details


// get_all_Acc_date

Route::get('/jobapply', [ContactController::class, 'inquiry'])->name('jobapply');


Route::get('/contact', [ContactController::class, 'Contact'])->name('contact');
Route::get('/apply', [ContactController::class, 'Contact'])->name('contact');




Route::POST('contact/store', [ContactController::class, 'ContactStore'])->name('contactstore');



Route::get('/{slug}', [HomeController::class, 'category'])->name('category');
Route::get('/{category}/{subcategory}', [HomeController::class, 'subcategory'])->name('subcategory');
