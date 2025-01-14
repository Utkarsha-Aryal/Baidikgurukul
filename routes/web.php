<?php

use App\Http\Controllers\BackPanel\AboutUsController;
use App\Http\Controllers\BackPanel\AuthController;
use App\Http\Controllers\BackPanel\ForgotPasswordController;
use App\Http\Controllers\BackPanel\GalleryController;
use App\Http\Controllers\BackPanel\GalleryImageController;
use App\Http\Controllers\BackPanel\GalleryVideoController;
use App\Http\Controllers\BackPanel\HomeController;
use App\Http\Controllers\BackPanel\TeamCategoryController;
use App\Http\Controllers\BackPanel\MessageFromController;
use App\Http\Controllers\BackPanel\OtpController;
use App\Http\Controllers\BackPanel\PostController;
use App\Http\Controllers\BackPanel\ServiceController;
use App\Http\Controllers\BackPanel\SiteSettingController;
use App\Http\Controllers\BackPanel\TeamMemberController;
use App\Http\Controllers\BackPanel\TestimonialController;
use App\Http\Controllers\BackPanel\TimelineController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;


Route::get('/clear-cache', function () {
    Artisan::call('optimize:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    return "Cache is cleared";
});
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* Backend-start */

Route::get('/', [AuthController::class, 'index'])->name('admin.login');
Route::get('admin/login', [AuthController::class, 'index'])->name('admin.login');
Route::get('admin/forgotpassword', [ForgotPasswordController::class, 'index'])->name('admin.forgotpassword');
Route::post('admin/checkuser', [ForgotPasswordController::class, 'isRegisteredUser'])->name('admin.checkuser');
Route::get('admin/otp', [OtpController::class, 'index'])->name('admin.otp');
Route::post('admin/validotp', [OtpController::class, 'isValidOtp'])->name('admin.validotp');
Route::get('admin/changepassword', [OtpController::class, 'indexChangePassword'])->name('admin.changepassword');
Route::post('admin/updatepassword', [ForgotPasswordController::class, 'updatePassword'])->name('admin.updatepassword');

Route::post('/loginuser', [AuthController::class, 'loginUser'])->name('loginuser');
Route::get('/logout', [AuthController::class, 'logOut'])->name('logout');

/* Reset password - start */
Route::get('admin/reset-password', [AuthController::class, 'resetPasswordForm'])->name('admin.reset-password');
/* Reset password  - end */

/* Reset password - start */
Route::post('/admin/resetpassword', [AuthController::class, 'resetPassword'])->name('admin.resetpassword');
/* Reset password  - end */

Route::group(['middleware' => 'admin'], function () {
    Route::group(['prefix' => 'admin'], function () {

        /* Dashboard - start */
        Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('admin.dashboard');
        /* Dashboard  - end */

        /* Profile-start */
        Route::group(['prefix' => 'profile'], function () {
            Route::get('/', [AuthController::class, 'profile'])->name('admin.profile');
            Route::post('/tab/get', [AuthController::class, 'getTabContent'])->name('admin.gettabcontent');
            Route::post('/image/update', [AuthController::class, 'uploadImage'])->name('admin.updateprofileimage');
            Route::post('/setting/update', [AuthController::class, 'updatePassword'])->name('admin.update');
            Route::post('/editprofile/updateprofile', [AuthController::class, 'updateProfileAll'])->name('admin.updateprofile');
        });
        /* Profile-end */

        /* Site settings - start */
        Route::group(['prefix' => 'sitesetting'], function () {
            Route::get('/', [SiteSettingController::class, 'siteSetting'])->name('admin.sitesetting');
            Route::post('/update', [SiteSettingController::class, 'updateSiteSetting'])->name('admin.sitesetting.update');
        });
        /** Site settings - end */

        /* About us - start */
        Route::group(['prefix' => 'aboutus'], function () {
            Route::get('/', [AboutUsController::class, 'aboutUs'])->name('admin.aboutus');
            Route::post('/update', [AboutUsController::class, 'updateAboutUs'])->name('admin.aboutus.update');
        });
        /* About us - end */

        /* Message from-start */
        Route::group(['prefix' => 'message'], function () {
            Route::get('/', [MessageFromController::class, 'index'])->name('admin.message');
            Route::post('/save', [MessageFromController::class, 'save'])->name('admin.message.save');
            Route::post('/list', [MessageFromController::class, 'list'])->name('admin.message.list');
            Route::post('form', [MessageFromController::class, 'form'])->name('admin.message.form');
            Route::post('/delete', [MessageFromController::class, 'delete'])->name('admin.message.delete');
        });
        /* Message from-end */

        /*Post=> News/Notice/Article/Events-start*/
        Route::group(['prefix' => 'post'], function () {
            Route::get('/', [PostController::class, 'index'])->name('admin.post');
            Route::post('/save', [PostController::class, 'save'])->name('admin.post.save');
            Route::any('/form', [PostController::class, 'form'])->name('admin.post.form');
            Route::post('/list', [PostController::class, 'list'])->name('admin.post.list');
            Route::post('/delete', [PostController::class, 'delete'])->name('admin.post.delete');
            Route::post('/deletefeatureimage', [PostController::class, 'deleteFeatureImage'])->name('admin.post.deletefeatureimage');
        });
        /*post=> News/Notice/Article/Events-end*/

        /*services-start */
        Route::group(['prefix' => 'service'], function () {
            Route::get('/', [ServiceController::class, 'index'])->name('admin.service');
            Route::post('/save', [ServiceController::class, 'save'])->name('admin.service.save');
            Route::post('/form', [ServiceController::class, 'form'])->name('admin.service.form');
            Route::post('/list', [ServiceController::class, 'list'])->name('admin.service.list');
            Route::post('/delete', [ServiceController::class, 'delete'])->name('admin.service.delete');
        });
        /*services-end */

        /*Testimonial-start */
        Route::group(['prefix' => 'testimonial'], function () {
            Route::get('/', [TestimonialController::class, 'index'])->name('admin.testimonial');
            Route::post('/save', [TestimonialController::class, 'save'])->name('admin.testimonial.save');
            Route::post('/list', [TestimonialController::class, 'list'])->name('admin.testimonial.list');
            Route::post('/delete', [TestimonialController::class, 'delete'])->name('admin.testimonial.delete');
        });
        /*Testimonial-end */

        /*Timeline-start */
        Route::group(['prefix' => 'timeline'], function () {
            Route::get('/', [TimelineController::class, 'index'])->name('admin.timeline');
            Route::post('/save', [TimelineController::class, 'save'])->name('admin.timeline.save');
            Route::post('/list', [TimelineController::class, 'list'])->name('admin.timeline.list');
            Route::post('/delete', [TimelineController::class, 'delete'])->name('admin.timeline.delete');
        });
        /*timeline-end */

        /* Gallery-start*/
        Route::group(['prefix' => 'gallery'], function () {
            Route::get('/', [GalleryController::class, 'index'])->name('admin.gallery');
            Route::post('/save', [GalleryController::class, 'save'])->name('admin.gallery.save');
            Route::post('/list', [GalleryController::class, 'list'])->name('admin.gallery.list');
            Route::post('/delete', [GalleryController::class, 'delete'])->name('admin.gallery.delete');

            Route::group(['prefix' => 'image'], function () {
                Route::post('/', [GalleryImageController::class, 'index'])->name('admin.gallery.image.index');
                Route::post('/save', [GalleryImageController::class, 'save'])->name('admin.gallery.image.save');
                Route::post('/list', [GalleryImageController::class, 'list'])->name('admin.gallery.image.list');
                Route::post('/delete', [GalleryImageController::class, 'delete'])->name('admin.gallery.image.delete');
            });

            Route::group(['prefix' => 'video'], function () {
                Route::post('/', [GalleryVideoController::class, 'index'])->name('admin.gallery.video.index');
                Route::post('/save', [GalleryVideoController::class, 'save'])->name('admin.gallery.video.save');
                Route::post('/list', [GalleryVideoController::class, 'list'])->name('admin.gallery.video.list');
                Route::post('/delete', [GalleryVideoController::class, 'delete'])->name('admin.gallery.video.delete');
            });
        });
        /* Gallery-end */

        /*Member tytpe-start */
        Route::group(['prefix' => 'teamcategory'], function () {
            Route::get('/', [TeamCategoryController::class, 'index'])->name('admin.teamcategory');
            Route::post('/save', [TeamCategoryController::class, 'save'])->name('admin.teamcategory.save');
            Route::post('/list', [TeamCategoryController::class, 'list'])->name('admin.teamcategory.list');
            Route::post('/delete', [TeamCategoryController::class, 'delete'])->name('admin.teamcategory.delete');
        });
        /*Member tytpe-end */

        /* Our Team member-start*/
        Route::group(['prefix' => 'member'], function () {
            Route::get('/', [TeamMemberController::class, 'index'])->name('admin.member');
            Route::post('/save', [TeamMemberController::class, 'save'])->name('admin.member.save');
            Route::any('/form', [TeamMemberController::class, 'form'])->name('admin.member.form');
            Route::post('/list', [TeamMemberController::class, 'list'])->name('admin.member.list');
            Route::post('/delete', [TeamMemberController::class, 'delete'])->name('admin.member.delete');
        });
        /* Our team member-end*/

    });
});

/* Backend-end */

// Front End Start here  


// Front End Start here 