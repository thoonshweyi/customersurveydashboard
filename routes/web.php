<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\RoleUsersController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashboardsController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\PermissionRolesController;
use App\Http\Controllers\SurveyResponsesController;

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

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('dashboards/dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get("/dashboards",[DashboardsController::class,'index'])->name("dashboards.index");

    Route::resource('users', UsersController::class);

    Route::resource('branches', BranchController::class);
    Route::get("/branchesstatus",[BranchController::class,"status"]);

    Route::resource('categories', CategoriesController::class);
    Route::resource("roles",RolesController::class);

    Route::resource("permissions",PermissionsController::class);
    Route::get("/permissionsstatus",[PermissionsController::class,"typestatus"]);
    Route::delete("/permissionsbulkdeletes",[PermissionsController::class,"bulkdeletes"])->name("permissions.bulkdeletes");

    Route::resource("permissionroles",PermissionRolesController::class);
    Route::delete("/permissionrolesbulkdeletes",[PermissionRolesController::class,"bulkdeletes"])->name("permissionroles.bulkdeletes");

    Route::resource("roleusers",RoleUsersController::class);
    Route::delete("/roleusersbulkdeletes",[RoleUsersController::class,"bulkdeletes"])->name("roleusers.bulkdeletes");

    Route::resource('forms',FormsController::class);
    Route::get('forms/{id}/report',[FormsController::class,"report"])->name('forms.report');
    Route::get('formsresponderlinks',[FormsController::class,"responderlinks"])->name('forms.responderlinks');
    Route::put('formsnotifications',[FormsController::class,"notifications"])->name('forms.notifications');


    Route::resource('surveyresponses',SurveyResponsesController::class);
    Route::get('surveyresponsesdashboard/{form_id}',[SurveyResponsesController::class,"dashboard"])->name("surveyresponsesdashboard");
    Route::get('surveyresponsesexport/{form_id}',[SurveyResponsesController::class,"export"])->name("surveyresponsesexport");
    Route::get('surveyresponsesemailnotifications',[SurveyResponsesController::class,"emailnotifications"])->name('forms.emailnotifications');

    Route::get('questions/{id}/refresh',[QuestionsController::class,"refresh"])->name("questions.refresh");


    // Route::get("categoriesaddmmname",function(){

    //     $mm_names = [
    //         1=>"ဘိလပ်မြေ",
    //         2=>"သံချောင်း",
    //         3=>"အမိုးနှင့်မျက်နှာကျက်များ",
    //         4=>"ရေချိုးခန်းသုံးပစ္စည်း",
    //         5=>"ပိုက်နှင့်ဆက်စပ်ပစ္စည်း",
    //         6=>"ဆောက်လုပ်ရေးလုပ်ငန်းသုံးပစ္စည်း",
    //         7=>"နံရံနှင့် အခင်းကြွေပြား",
    //         8=>"တံခါးနှင့်ပြတင်းပေါက်",
    //         9=>"လျှပ်စစ်မီးနှင့်ဆက်စပ်ပစ္စည်း",
    //         10=>"အိမ်သုံးအီလတ်ထရောနစ်ပစ္စည်း",
    //         11=>"အိမ်သုတ်ဆေးနှင့်ဓာတုပစ္စည်း",
    //         12=>"မီးဖိုခန်းသုံးပစ္စည်း",
    //         13=>"ပရိဘောဂပစ္စည်း",
    //         14=>"စာရေးကိရိယာနှင့်ဒစ်ဂျစ်တယ်ပစ္စည်း",
    //     ];

    //     $categories = \App\Models\Category::where("status_id",1)->get();

    //     foreach($categories as $category){
    //         $category_mmname = $mm_names[$category->id] ?? '';
    //         $category->mm_name = $category_mmname;
    //         $category->save();
    //     }
    //     dd("Changed Myanmar name successfully");
    //     // dd($categories);
    // });


    //  Route::get("branchesaddmmname",function(){
    //     $mm_names = [
    //         1=> "လမ်းသစ်",
    //         2=> "သိပ္ပံ",
    //         3=> "စက်ဆန်း",
    //         9=> "အရှေ့ဒဂုံ",
    //         10=> "မော်လမြိုင်",
    //         11=> "တမ္ပဝတီ ",
    //         19=> "လှိုင်သာယာ",
    //         21=> "အေးသာယာ",
    //         27=> "PRO 1 PLUS (Terminal M)",
    //         28=> "တောင်ဒဂုံ",
    //         30=> "ဒညင်းကုန်း",
    //         23=> "ပဲခူး",
    //         22=> "မင်္ဂလာဒုံ",
    //         32=> "နေပြည်တော်",
    //     ];

    //     $branches = \App\Models\Branch::where("status_id",1)->get();
    //     // $branch_ids = $branches->pluck("branch_name")->toArray();
    //     // dd(join("=>\n",$branch_ids));


    //     foreach($branches as $branch){
    //         $branch_mmname = $mm_names[$branch->branch_id] ?? '';
    //         $branch->mm_name = $branch_mmname;
    //         $branch->save();
    //     }
    //     dd("Add Branch Myanmar name successfully");
    //     // dd($categories);
    // });
});



require __DIR__.'/auth.php';
