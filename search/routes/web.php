<?php

use App\Http\Controllers\EducationController;
use App\Http\Controllers\JobWorkController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\SaveJobController;
use App\Http\Controllers\SkillsController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use TCG\Voyager\Facades\Voyager;

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

Route::get('/', function () {
    $vacancy = DB::table('company_vacancy')->orderBy('id','DESC')->paginate(10);
    return view('template.index',compact('vacancy'));
})->name('home');

Route::get('/register',[AuthManager::class, 'register'])->name('register');

Route::get('/auth', [AuthManager::class, 'login'])->name('login');

Route::post('/auth', [AuthManager::class, 'loginPost'])->name('login.post');

Route::post('/register', [AuthManager::class, 'registerPost'])->name('register.post');

Route::get('/logout',[AuthManager::class, 'logout'])->name('logout');

Route::get('/about', function (){
    return view('template.about');
})->name('about');

Route::get('/list', function (){
    return view('template.list');
})->name('list');

Route::get('/contact', function (){
    return view('template.contact');
})->name('contact');


Route::group(['middleware'=>'auth'],function (){

   Route::get('/user_profile', function (){
      return view('template.user.profile');
   })->name('user_profile');

//    Route::get('/user_profile', [UserProfileController::class, 'index'])->name('user_profile');

    Route::resource('/create_user_profile',UserProfileController::class);

    Route::resource('/create_user_skills',SkillsController::class);

    Route::resource('/user_create_work',JobWorkController::class);

    Route::resource('/user_create_education',EducationController::class);

    Route::resource('/user_create_portfolio',PortfolioController::class);

    Route::resource('/save_job',SaveJobController::class);

//    Route::post('/create_user_skills/create', [SkillsController::class, 'store']);

//    Route::get('/update_user_profile/{user_id}', function ($user_id){
//        $user_profile = DB::table('user_profile')->where('user_id',$user_id)->first();
//        return view('template.user.create_user',compact('user_profile'));
//    })->name('update_user_profile');


   Route::get('/vacancy/{id} ',function ($id){
       $vacancy = DB::table('company_vacancy')->where('id',$id)->first();

       if ($vacancy ==null) {
           abort(404); // Not found error
       }
       return view('template.details',compact('vacancy'));
//       return $vacancy;
   })->name('vacancy');
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
