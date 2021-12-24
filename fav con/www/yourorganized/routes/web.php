<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;


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

/*Route::get('/', function () {
    return view('welcome');
});*/

//Auth::routes();

Route::get('/', [HomeController::class, 'home'])->name('login');
Route::get('/blog', [HomeController::class, 'blog']);
Route::get('/faq', [HomeController::class, 'faq']);
Route::get('/upgrade', [HomeController::class, 'upgrade']);
Route::get('/faq/{id}/{text?}/{text2?}', [HomeController::class, 'viewfaq']);







Route::get('/clear-cache', function() {
   
    $exitCode = Artisan::call('config:clear');
    echo "Sheri";
    // return what you want
});

Route::get('/migrate', function(){
    Artisan::call('migrate');
   // dd('migrated!);
});

/*************User Routes******************/


Route::match(['get', 'post'], 'register', [App\Http\Controllers\Auth\RegisterController::class, 'user']);
Route::match(['get', 'post'], 'login', [App\Http\Controllers\Auth\LoginController::class, 'user']);
Route::match(['get', 'post'], 'forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'user'])->name('password.email');
Route::match(['get', 'post'], 'forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'user_reset'])->name('password.reset');
Route::match(['get', 'post'], 'drills', [UserController::class, 'drills']);
Route::match(['get', 'post'], 'drill/{id}', [UserController::class, 'viewdrill']);
Route::match(['get', 'post'], 'drill/preview/{id}', [UserController::class, 'previewDrill'])->name('drill.preview');
Route::match(['get', 'post'], 'plans', [UserController::class, 'plans']);
Route::match(['get', 'post'], 'plan/{id}', [UserController::class, 'viewplan']);
Route::match(['post'], 'delete/plan', [UserController::class, 'deletePlan']);
Route::match(['post'], 'delete/drill', [UserController::class, 'deleteDrill']);
Route::match(['get'], 'plan/note/delete/{id}', [UserController::class, 'deletePlanNote'])->name('deletePlanNote');
Route::match(['get'], 'plan/drill/delete/{id}', [UserController::class, 'deletePlanDrill'])->name('deletePlanDrill');
Route::match(['get', 'post'], 'myprofile', [UserController::class, 'myprofile']);
Route::match(['post'], 'addTeam', [UserController::class, 'addTeam']);
Route::match(['get', 'post'], 'team/{id}', [UserController::class, 'viewTeam']);
Route::match(['get'], 'my_coaches_list/{team_id}', [UserController::class, 'my_coaches_list']);
Route::match(['post'], 'addToTeam', [UserController::class, 'addToTeam']);
Route::match(['get'], 'delete/from/team/{team_id}/{member_id}', [UserController::class, 'deleteFromTeam']);
Route::match(['post'], 'add/association', [UserController::class, 'addAssociation']);
Route::match(['post'], 'update/association', [UserController::class, 'updateAssociation']);
Route::match(['get'], 'association/{id}', [UserController::class, 'viewAssociation']);
Route::match(['get'], 'association/image/{id}', [UserController::class, 'viewAssociationImage']);
Route::match(['post'], 'association/add/team', [UserController::class, 'addAssociationTeam']);
Route::match(['post'], 'association/add/coach', [UserController::class, 'addAssociationTeamCoach']);
Route::match(['get'], 'home', [UserController::class, 'viewplan']);
Route::match(['post'], 'user/credentials', [UserController::class, 'changepassword']);
Route::match(['post'], 'user_images', [UserController::class, 'addProfilePic']);
Route::match(['get'], 'user_images/image/{id}', [UserController::class, 'viewProfilePic']);




Route::get('logout', function () {
    
    Auth::logout();    
    return redirect('/');
});



/************* User Routes End******************/


/*******************Admin Routes************** */



$admin_url=DB::table('url_settings')->where('id',1)->value('admin_url');

Route::match(['get', 'post'], $admin_url.'login', [App\Http\Controllers\Auth\LoginController::class, 'admin'])->name('admin');
Route::get($admin_url.'dashboard', [AdminController::class, 'dashboard']);
Route::match(['get', 'post'], $admin_url.'add-faq', [AdminController::class, 'addfaq']);
Route::match(['get'], $admin_url.'users', [AdminController::class, 'users']);
Route::match(['get'], $admin_url.'users_list', [AdminController::class, 'users_list']);
Route::match(['get'], $admin_url.'coaches', [AdminController::class, 'coaches']);
Route::match(['get'], $admin_url.'coaches_list', [AdminController::class, 'coaches_list']);
Route::match(['get'], $admin_url.'viewuserimage/{id}', [AdminController::class, 'viewuserimage']);

Route::match(['get','post'], $admin_url.'tags', [AdminController::class, 'tags']);
Route::match(['post'], 'tags/plan', [AdminController::class, 'tags']);
Route::match(['post'], 'tags/drill', [AdminController::class, 'tags']);

Route::get($admin_url.'viewuser/{id}', [AdminController::class, 'viewuser']);
Route::get($admin_url.'viewcoach/{id}', [AdminController::class, 'viewcoach']);
Route::match(['get'], $admin_url.'login-history', [AdminController::class, 'loginhistory']);
Route::match(['get'], $admin_url.'login-history_list', [AdminController::class, 'loginhistory_list']);
Route::match(['get','post'], $admin_url.'manage/faq', [AdminController::class, 'manage_faq']);
Route::match(['get'], $admin_url.'faq_categrory_list', [AdminController::class, 'faq_categrory_list']);
Route::match(['get','post'], $admin_url.'view/faqs/{id}', [AdminController::class, 'faq_list']);
Route::match(['get'], $admin_url.'view/faqs/{id}/delete/{faq_id}', [AdminController::class, 'delete_faq']);
Route::match(['get'], $admin_url.'view/faqs/{id}/delete', [AdminController::class, 'delete_faq_category']);
Route::match(['post','get'], $admin_url.'faq/youtube/videos', [AdminController::class, 'faqvideos']);
Route::match(['post'], $admin_url.'faq/youtube/videos/edit/', [AdminController::class, 'faqvideosedit']);
Route::match(['post'], $admin_url.'faq/youtube/videos/delete/{id}', [AdminController::class, 'faqvideosdelete']);

Route::match(['post','get'], $admin_url.'home/sliders', [AdminController::class, 'homesliders']);
Route::match(['post'], $admin_url.'home/sliders/edit/', [AdminController::class, 'homeslidersedit']);
Route::match(['post'], $admin_url.'home/sliders/delete/{id}', [AdminController::class, 'homeslidersdelete']);

Route::match(['get'], $admin_url.'visitors', [AdminController::class, 'visitors']);
Route::match(['get'], $admin_url.'visitors_list', [AdminController::class, 'visitors_list']);


Route::match(['get','post'], $admin_url.'tags', [AdminController::class, 'tags']);


Route::match(['post'], $admin_url.'tags/plan', [AdminController::class, 'tags']);
Route::match(['get'], $admin_url.'manage_plans', [AdminController::class, 'manage_plans']);
Route::match(['get'], $admin_url.'plans_list', [AdminController::class, 'plans_list']);
Route::match(['get'], $admin_url.'user_plans/{id}', [AdminController::class, 'user_plans']);
Route::get($admin_url.'viewplans/{id}', [AdminController::class, 'viewplans']);
Route::match(['get','post'], $admin_url.'view_plantags', [AdminController::class, 'view_plantags']);
Route::match(['get','post'], $admin_url.'delete_plantag/{id}', [AdminController::class, 'delete_plantag']);
Route::match(['get','post'], $admin_url.'delete/plan', [AdminController::class, 'delete_plan']);

Route::match(['post'], $admin_url.'tags/drill', [AdminController::class, 'tags']);
Route::match(['get'], $admin_url.'manage_drills', [AdminController::class, 'manage_drills']);
Route::match(['get'], $admin_url.'drills_list', [AdminController::class, 'drills_list']);
Route::match(['get'], $admin_url.'user_drills/{id}', [AdminController::class, 'user_drills']);
Route::get($admin_url.'viewdrills/{id}', [AdminController::class, 'viewdrills']);
Route::match(['get'], $admin_url.'view_drilltags', [AdminController::class, 'view_drilltags']);
Route::match(['get','post'], $admin_url.'delete_drilltag/{id}', [AdminController::class, 'delete_drilltag']);
Route::match(['get','post'], $admin_url.'delete/drill', [AdminController::class, 'delete_drill']);

Route::match(['get','post'], $admin_url.'manage_associations', [AdminController::class, 'manage_associations']);
Route::match(['get','post'], $admin_url.'viewassociation/{id}', [AdminController::class, 'viewAssociation']);
Route::match(['get'], $admin_url.'association/image/{id}', [AdminController::class, 'viewAssociationImage']);
Route::match(['get','post'], $admin_url.'associations_list', [AdminController::class, 'associations_list']);
Route::match(['get','post'], $admin_url.'team/{id}', [AdminController::class, 'user_teams']);
Route::match(['get','post'], $admin_url.'viewteam/{id}', [AdminController::class, 'viewteam']);


Route::get($admin_url.'logout', function () {
    
    Auth::guard('admin')->logout();    
    return redirect('/');
});

/************* Admin Routes End******************/


