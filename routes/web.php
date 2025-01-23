<?php

use App\Http\Controllers\BackPanel\AboutUsController;
use App\Http\Controllers\BackPanel\AuthController;
use App\Http\Controllers\BackPanel\DonorController;
use App\Http\Controllers\BackPanel\ForgotPasswordController;
use App\Http\Controllers\BackPanel\GalleryController;
use App\Http\Controllers\BackPanel\GalleryImageController;
use App\Http\Controllers\BackPanel\GalleryVideoController;
use App\Http\Controllers\BackPanel\HomeController;
use App\Http\Controllers\BackPanel\MessageFromController;
use App\Http\Controllers\BackPanel\OtpController;
use App\Http\Controllers\BackPanel\PostController;
use App\Http\Controllers\BackPanel\ServiceController;
use App\Http\Controllers\BackPanel\SiteSettingController;
use App\Http\Controllers\BackPanel\TeamMemberController;
use App\Http\Controllers\BackPanel\TeamCategoryController;
use App\Http\Controllers\BackPanel\TimeIntervalController;
use App\Http\Controllers\BackPanel\TestimonialController;
use App\Http\Controllers\BackPanel\TimelineController;
use App\Http\Controllers\BackPanel\EventController;
use App\Http\Controllers\BackPanel\HistoryController;
use App\Http\Controllers\BackPanel\FAQController;
use App\Http\Controllers\BackPanel\ProgramController;
use App\Http\Controllers\BackPanel\RitualController;
use App\Http\Controllers\BackPanel\EnquiryController as BackEnquiryController;
use App\Http\Controllers\frontpanel\ContactController;
use App\Http\Controllers\frontpanel\DonarController;
use App\Http\Controllers\frontpanel\EventController as FrontEventController;
use App\Http\Controllers\frontpanel\FaqController as FrontFAQController;
use App\Http\Controllers\frontpanel\FormController;
use App\Http\Controllers\frontpanel\GalleryController as FrontGalleryController;
use App\Http\Controllers\frontpanel\HistoryController as FrontHistoryController;
use App\Http\Controllers\frontpanel\HomeController as FrontHomeController;
use App\Http\Controllers\frontpanel\IntroductionController;
use App\Http\Controllers\frontpanel\NewsController;
use App\Http\Controllers\frontpanel\ProgramController as FrontProgramController;
use App\Http\Controllers\frontpanel\RulesController;
use App\Http\Controllers\frontpanel\TeamController;
use App\Http\Controllers\frontpanel\EnquiryController;
use App\Http\Controllers\ContactController as frontContact;
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
            Route::post('/view', [MessageFromController::class, 'view'])->name('admin.message.view');
        });
        /* Message from-end */

        /*Post=> News/Notice/Article/Events-start*/
        Route::group(['prefix' => 'post'], function () {
            Route::get('/', [PostController::class, 'index'])->name('admin.post');
            Route::post('/save', [PostController::class, 'save'])->name('admin.post.save');
            Route::any('/form', [PostController::class, 'form'])->name('admin.post.form');
            Route::post('/list', [PostController::class, 'list'])->name('admin.post.list');
            Route::post('/delete', [PostController::class, 'delete'])->name('admin.post.delete');
            Route::post('/view', [PostController::class, 'view'])->name('admin.post.view');
            Route::post('/restore', [PostController::class, 'restore'])->name('admin.post.restore');
            Route::post('/deletefeatureimage', [PostController::class, 'deleteFeatureImage'])->name('admin.post.deletefeatureimage');
            Route::post('/upload-image', [PostController::class, 'uploadImage'])->name('admin.post.upload.image');
            Route::post('/delete-upload-image', [PostController::class, 'deleteuploadImage'])->name('admin.post.delete.upload.image');
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
            Route::post('/restore', [TimelineController::class, 'restore'])->name('admin.timeline.restore');
        });
        /*timeline-end */

        /* Gallery-start*/
        Route::group(['prefix' => 'gallery'], function () {
            Route::get('/', [GalleryController::class, 'index'])->name('admin.gallery');
            Route::post('/save', [GalleryController::class, 'save'])->name('admin.gallery.save');
            Route::post('/list', [GalleryController::class, 'list'])->name('admin.gallery.list');
            Route::post('/delete', [GalleryController::class, 'delete'])->name('admin.gallery.delete');
            Route::post('/restore', [GalleryController::class, 'restore'])->name('admin.gallery.restore');

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

        /* Our Team member-start*/
        Route::group(['prefix' => 'member'], function () {
            Route::get('/', [TeamMemberController::class, 'index'])->name('admin.member');
            Route::post('/save', [TeamMemberController::class, 'save'])->name('admin.member.save');
            Route::any('/form', [TeamMemberController::class, 'form'])->name('admin.member.form');
            Route::post('/list', [TeamMemberController::class, 'list'])->name('admin.member.list');
            Route::post('/delete', [TeamMemberController::class, 'delete'])->name('admin.member.delete');
            Route::post('/restore', [TeamMemberController::class, 'restore'])->name('admin.member.restore');
            Route::post('/view', [TeamMemberController::class, 'view'])->name('admin.member.view');
        });
        /* Our team member-end*/


        Route::group(['prefix' => 'memberCategory'], function () {
            Route::get('/', [TeamCategoryController::class, 'index'])->name('admin.teamcategory');
            Route::post('/save', [TeamCategoryController::class, 'save'])->name('admin.teamcategory.save');
            Route::post('/list', [TeamCategoryController::class, 'list'])->name('admin.teamcategory.list');
            Route::post('/delete', [TeamCategoryController::class, 'delete'])->name('admin.teamcategory.delete');
            Route::post('/restore', [TeamCategoryController::class, 'restore'])->name('admin.teamcategory.restore');
        });


        Route::group(['prefix' => 'timeinterval'], function () {
            Route::get('/', [TimeIntervalController::class, 'index'])->name('admin.timeinterval');
            Route::post('/save', [TimeIntervalController::class, 'save'])->name('admin.timeinterval.save');
            Route::post('/list', [TimeIntervalController::class, 'list'])->name('admin.timeinterval.list');
            Route::post('/delete', [TimeIntervalController::class, 'delete'])->name('admin.timeinterval.delete');
            Route::post('/restore', [TimeIntervalController::class, 'restore'])->name('admin.timeinterval.restore');
        });
        //Our program start here
        Route::group(['prefix' => 'program'], function () {
            Route::get('/', [ProgramController::class, 'index'])->name('admin.program');
            Route::post('/upload-image', [ProgramController::class, 'uploadImage'])->name('upload.image');
            Route::post('delete/upload-image', [ProgramController::class, 'deleteuploadImage'])->name('admin.delete.upload.image');
            Route::post('/save', [ProgramController::class, 'save'])->name('admin.program.save');
            Route::any('/form', [ProgramController::class, 'form'])->name('admin.program.form');
            Route::post('/list', [ProgramController::class, 'list'])->name('admin.program.list');
            Route::post('/delete', [ProgramController::class, 'delete'])->name('admin.program.delete');
            Route::post('/restore', [ProgramController::class, 'restore'])->name('admin.program.restore');
            Route::post('/view', [ProgramController::class, 'view'])->name('admin.program.view');
        });
        //Our program end here

        //Our donor start here
        Route::group(['prefix' => 'donor'], function () {
            Route::get('/', [DonorController::class, 'index'])->name('admin.donor');
            Route::post('/save', [DonorController::class, 'save'])->name('admin.donor.save');
            Route::any('/form', [DonorController::class, 'form'])->name('admin.donor.form');
            Route::post('/list', [DonorController::class, 'list'])->name('admin.donor.list');
            Route::post('/delete', [DonorController::class, 'delete'])->name('admin.donor.delete');
            Route::post('/restore', [DonorController::class, 'restore'])->name('admin.donor.restore');
            Route::post('/view', [DonorController::class, 'view'])->name('admin.donor.view');
            Route::post('/upload-image', [DonorController::class, 'uploadImage'])->name('admin.donar.upload.image');
        });
        //Our donor end here

        /*Event start here*/
        Route::group(['prefix' => 'event'], function () {
            Route::get('/', [EventController::class, 'index'])->name('admin.event');
            Route::post('/save', [EventController::class, 'save'])->name('admin.event.save');
            Route::any('/form', [EventController::class, 'form'])->name('admin.event.form');
            Route::post('/list', [EventController::class, 'list'])->name('admin.event.list');
            Route::post('/delete', [EventController::class, 'delete'])->name('admin.event.delete');
            Route::post('/deletefeatureimage', [EventController::class, 'deleteFeatureImage'])->name('admin.event.deletefeatureimage');
            Route::post('/restore', [EventController::class, 'restore'])->name('admin.event.restore');
            Route::post('/view', [EventController::class, 'view'])->name('admin.event.view');
            Route::post('/upload-image', [EventController::class, 'uploadImage'])->name('admin.event.upload.image');
            Route::post('/delete-upload-image', [EventController::class, 'deleteuploadImage'])->name('admin.event.delete.upload.image');
        });
        /*Event end*/

        //history start here
        Route::group(['prefix' => 'history'], function () {
            Route::get('/', [HistoryController::class, 'index'])->name('admin.history');
            Route::post('/save', [HistoryController::class, 'save'])->name('admin.history.save');
            Route::any('/form', [HistoryController::class, 'form'])->name('admin.history.form');
            Route::post('/list', [HistoryController::class, 'list'])->name('admin.history.list');
            Route::post('/delete', [HistoryController::class, 'delete'])->name('admin.history.delete');
            Route::post('/deletefeatureimage', [HistoryController::class, 'deleteFeatureImage'])->name('admin.history.deletefeatureimage');
            Route::post('/restore', [HistoryController::class, 'restore'])->name('admin.history.restore');
            Route::post('/view', [HistoryController::class, 'view'])->name('admin.history.view');
            Route::post('/upload-image', [HistoryController::class, 'uploadImage'])->name('admin.history.upload.image');
            Route::post('delete/upload-image', [HistoryController::class, 'deleteuploadImage'])->name('admin.delete.upload.image');
        });
        //history end here

        //FAQ start here
        Route::group(['prefix' => 'faq'], function () {
            Route::get('/', [FAQController::class, 'index'])->name('admin.faq');
            Route::post('/save', [FAQController::class, 'save'])->name('admin.faq.save');
            Route::any('/form', [FAQController::class, 'form'])->name('admin.faq.form');
            Route::post('/list', [FAQController::class, 'list'])->name('admin.faq.list');
            Route::post('/delete', [FAQController::class, 'delete'])->name('admin.faq.delete');
            Route::post('/restore', [FAQController::class, 'restore'])->name('admin.faq.restore');
        });
        //FAQ end here

        //ritual start here
        Route::group(['prefix' => 'ritual'], function () {
            Route::get('/', [RitualController::class, 'index'])->name('admin.ritual');
            Route::post('/save', [RitualController::class, 'save'])->name('admin.ritual.save');
            Route::any('/form', [RitualController::class, 'form'])->name('admin.ritual.form');
            Route::post('/list', [RitualController::class, 'list'])->name('admin.ritual.list');
            Route::post('/delete', [RitualController::class, 'delete'])->name('admin.ritual.delete');
            Route::post('/deletefeatureimage', [RitualController::class, 'deleteFeatureImage'])->name('admin.ritual.deletefeatureimage');
            Route::post('/restore', [RitualController::class, 'restore'])->name('admin.ritual.restore');
            Route::post('/view', [RitualController::class, 'view'])->name('admin.ritual.view');
            Route::post('/upload-image', [RitualController::class, 'uploadImage'])->name('admin.ritual.upload.image');
            Route::post('delete/upload-image', [RitualController::class, 'deleteuploadImage'])->name('admin.ritual.upload.image');
        });
        //ritual end here

        //ritual start here
        Route::group(['prefix' => 'contact'], function () {
            Route::get('/', [BackEnquiryController::class, 'index'])->name('admin.enquiry');
            Route::post('/list', [BackEnquiryController::class, 'list'])->name('admin.enquiry.list');
            Route::post('/delete', [BackEnquiryController::class, 'delete'])->name('admin.enquiry.delete');
            Route::post('/view', [BackEnquiryController::class, 'view'])->name('admin.enquiry.view');
            Route::post('/restore', [BackEnquiryController::class, 'restore'])->name('admin.enquiry.restore');
        });
        //ritual end here
    });
});
/* Backend-end */

// Front End Start here  
Route::get('/home', [FrontHomeController::class, 'index'])->name('home');

Route::get('about', [IntroductionController::class, 'introduction'])->name('about');

Route::get('new', [IntroductionController::class, 'new'])->name('new');

Route::get('team/{slug}', [TeamController::class, 'ourteam'])->name('ourteam');
Route::get('teaminner/{slug}', [TeamController::class, 'teaminner'])->name('teaminner');
Route::get('year/{slug}', [TeamController::class, 'teamyear'])->name('teamyear');

Route::get('program', [FrontProgramController::class, 'program'])->name('program');
Route::get('program/innerpage/{slug}', [FrontProgramController::class, 'inner'])->name('program.inner');

Route::get('gallery', [FrontGalleryController::class, 'gallery'])->name('gallery');
Route::get('videinner/{slug}', [FrontGalleryController::class, 'ginner'])->name('ginner');
Route::get('imageinner/{slug}', [FrontGalleryController::class, 'imageInner'])->name('image.inner');

Route::get('news', [NewsController::class, 'news'])->name('news');
Route::get('news/innerpage/{slug}', [NewsController::class, 'innerpage'])->name('news.inner.page');

Route::get('historyinner', [FrontHistoryController::class, 'history'])->name('history');
Route::get('historyinner/{slug}', [FrontHistoryController::class, 'inner'])->name('history.inner');
Route::get('historyinners/{slug}', [FrontHistoryController::class, 'inners'])->name('history.inners');


// Route::get('history', [RulesController::class, 'history'])->name('history');
Route::get('rules', [RulesController::class, 'rules'])->name('rules');

Route::get('birth', [RulesController::class, 'birth'])->name('birth');

Route::get('faq', [FrontFAQController::class, 'faq'])->name('faq');

Route::get('event', [FrontEventController::class, 'event'])->name('event');
Route::get('event/innerpage/{slug}', [FrontEventController::class, 'innerpage'])->name('event.inner.page');

Route::get('contact', [ContactController::class, 'contact'])->name('contact');

Route::get('list', [DonarController::class, 'list'])->name('list');

Route::get('form', [FormController::class, 'form'])->name('form');


Route::post('senddata', [EnquiryController::class, 'save'])->name('enquiry.save');

// Front End Start here 