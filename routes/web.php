<?php

use App\Exports\PresenceExport;
use App\Models\Presence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermitController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\StatusPermitController;
use App\Http\Controllers\RoleManagementController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\InformationPermitController;
use App\Http\Controllers\ClassroomManagementController;
use App\Http\Controllers\PermissionManagementController;
use Maatwebsite\Excel\Facades\Excel;

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

// guest
Route::middleware('guest')->group(function(){
    Route::get('/', [UserController::class, 'login'])->name('login');
    Route::post('/', [UserController::class, 'loginRequest']);
});

// profile
Route::get('/setting', [UserController::class, 'setting']);
Route::get('/change-password', [UserController::class, 'changePassword']);

// role
Route::middleware(['auth'])->group(function(){
    Route::resource('/role-managements', RoleManagementController::class)->only('index')->middleware('permission:get-role');
    Route::resource('/role-managements', RoleManagementController::class)->only('store')->middleware('permission:create-role');
    Route::resource('/role-managements', RoleManagementController::class)->only('update')->middleware('permission:update-role');
    Route::resource('/role-managements', RoleManagementController::class)->only('destroy')->middleware('permission:delete-role');
});

// permissions
Route::middleware(['auth'])->group(function(){
    Route::resource('/permission-managements', PermissionManagementController::class)->only('index')->middleware('permission:get-permission');
    Route::resource('/permission-managements', PermissionManagementController::class)->only('store')->middleware('permission:create-permission');
    Route::resource('/permission-managements', PermissionManagementController::class)->only('update')->middleware('permission:update-permission');
    Route::resource('/permission-managements', PermissionManagementController::class)->only('destroy')->middleware('permission:delete-permission');
});

// user
Route::middleware(['auth'])->group(function(){
    Route::resource('/user-managements', UserManagementController::class)->only('index')->middleware('permission:get-user');
    Route::resource('/user-managements', UserManagementController::class)->only('store')->middleware('permission:create-user');
    Route::resource('/user-managements', UserManagementController::class)->only('update')->middleware('permission:update-user');
    Route::resource('/user-managements', UserManagementController::class)->only('destroy')->middleware('permission:delete-user');

    Route::post('/logout', [UserController::class, 'logout']);
    Route::get('/download', function(Request $request){
        if(!$request->file || !$request->data){
            return back();
        }

        $data = Storage::get($request->file);
        if(!$data){
            return back();
        }

        $ext_new_file = explode('.', $request->file);

        return Storage::download($request->file, $request->data . '.' . $ext_new_file[1]);
    });
});

// classrooom
Route::middleware(['auth'])->group(function(){
    Route::resource('/classrooms', ClassroomManagementController::class)->only('index')->middleware('permission:get-classroom');
    Route::resource('/classrooms', ClassroomManagementController::class)->only('store')->middleware('permission:create-classroom');
    Route::resource('/classrooms', ClassroomManagementController::class)->only('update')->middleware('permission:update-classroom');
    Route::resource('/classrooms', ClassroomManagementController::class)->only('destroy')->middleware('permission:delete-classroom');
});

// permit
Route::middleware(['auth'])->group(function(){
    Route::resource('/permits', PermitController::class)->only('index')->middleware('permission:get-permit');
    Route::resource('/permits', PermitController::class)->only('store')->middleware('permission:create-permit');
    Route::resource('/permits', PermitController::class)->only('update')->middleware('permission:update-permit');
    Route::resource('/permits', PermitController::class)->only('destroy')->middleware('permission:delete-permit');
});

// status permit
Route::middleware(['auth'])->group(function(){
    Route::resource('/status-permits', StatusPermitController::class)->only('index')->middleware('permission:get-status-permit');
    Route::resource('/status-permits', StatusPermitController::class)->only('store')->middleware('permission:create-status-permit');
    Route::resource('/status-permits', StatusPermitController::class)->only('update')->middleware('permission:update-status-permit');
    Route::resource('/status-permits', StatusPermitController::class)->only('destroy')->middleware('permission:delete-status-permit');
});

// status permit
Route::middleware(['auth'])->group(function(){
    Route::resource('/information-permits', InformationPermitController::class)->only('index')->middleware('permission:get-information-permit');
    Route::resource('/information-permits', InformationPermitController::class)->only('store')->middleware('permission:create-information-permit');
    Route::resource('/information-permits', InformationPermitController::class)->only('update')->middleware('permission:update-information-permit');
    Route::resource('/information-permits', InformationPermitController::class)->only('destroy')->middleware('permission:delete-information-permit');
});

// task
Route::middleware(['auth'])->group(function(){
    Route::resource('/tasks', TaskController::class)->only('index')->middleware('permission:get-task');
    Route::resource('/tasks', TaskController::class)->only('store')->middleware('permission:create-task');
    Route::resource('/tasks', TaskController::class)->only('update')->middleware('permission:update-task');
    Route::resource('/tasks', TaskController::class)->only('destroy')->middleware('permission:delete-task');
});

// presence
Route::middleware(['auth'])->group(function(){
    Route::resource('/presences', PresenceController::class)->only('index')->middleware('permission:get-presence');
    Route::resource('/presences', PresenceController::class)->only('store')->middleware('permission:create-presence');
    Route::resource('/presences', PresenceController::class)->only('update')->middleware('permission:update-presence');
    Route::resource('/presences', PresenceController::class)->only('destroy')->middleware('permission:delete-presence');
    Route::get('/presences/export', function(Request $request){
       if($request->from_filter && $request->until_filter){
            $data = Presence::whereBetween('date', [$request->from_filter, $request->until_filter])->orderBy('date', 'desc')->get();

            return Excel::download(new PresenceExport($data), 'presence.xlsx');
        } else {
            $data = Presence::all();
            return Excel::download(new PresenceExport($data), 'presence.xlsx');
       }
    });
});

// wakasek
Route::middleware(['auth'])->group(function(){
    Route::put('/approve-permit/{permit}', [PermitController::class, 'approve'])->middleware('permission:approve-permit');
});
