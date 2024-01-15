<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Fronted\FrontedController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PostCountController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// All blog page/Fronted link routes


    Route::group(['middleware' => 'lang'], static function(){

    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/', [FrontedController::class, 'index'])->name('front.index');
    Route::get('/all-post', [FrontedController::class, 'all_post'])->name('front.all_post');
    Route::get('/search', [FrontedController::class, 'search'])->name('front.search');
    Route::get('/category/{slug}', [FrontedController::class, 'category'])->name('front.category');
    Route::get('/category/{cat_slug}/{sub_cat_slug}', [FrontedController::class, 'sub_category'])->name('front.sub_category');
    Route::get('/tag/{slug}', [FrontedController::class, 'tag'])->name('front.tag');
    Route::get('/single-post/{slug}', [FrontedController::class, 'single'])->name('front.single');
    Route::get('contact', [FrontedController::class, 'contact'])->name('front.contact');
    Route::post('contact', [ContactController::class, 'store'])->name('contact.store');
    Route::get('get-districts/{division_id}', [UserProfileController::class, 'getDistrict']);
    Route::get('get-thanas/{district_id}', [UserProfileController::class, 'getThana']);
    Route::get('post-count/{post_id}', [FrontedController::class, 'postReadCount']);
    Route::get('switch-language', [FrontedController::class, 'switch_language'])->name('switch.language');
    
    Route::post('category/status/{id}', [CategoryController::class, 'status'])->name('category.status');
    Route::post('sub-category/status/{id}', [SubCategoryController::class, 'status'])->name('sub-category.status');
    Route::post('tag/status/{id}', [TagController::class, 'status'])->name('tag.status');
    Route::post('tagstore/tagstore/{id}', [PostController::class, 'TagStore'])->name('tagstore.com');
    Route::post('post/status/{id}', [PostController::class, 'status'])->name('post.status');
    // Route::post('add-comment', [CommentController::class, 'store'])->name('comment.store');
    
    
    // Admin page routes
    Route::group(['prefix'=>'admin', 'middleware' => 'auth'], function (){
        Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
        Route::post('upload-photo', [UserProfileController::class, 'upload_photo'])->name('user.upload_photo');
        Route::get('get-subcategory/{id}', [SubCategoryController::class, 'getSubCategoryByCategoryId']);
        Route::resource('post', PostController::class);
        Route::resource('comment', CommentController::class);
        Route::resource('profile', UserProfileController::class);
    
        Route::group(['middleware'=> 'admin'], static function(){
        Route::resource('category', CategoryController::class);
        Route::resource('sub-category', SubCategoryController::class);
        Route::resource('tag', TagController::class);
        
    });
    
    });
    
    
    Route::get('/dashboard', function ()
    {return view('dashboard');})->middleware(['auth', 'verified'])->name('dashboard');
    
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
    
    require __DIR__.'/auth.php';
});








