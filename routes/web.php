<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CookieController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HelpdeskController;


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





Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('dashboard', [
            'title' => 'Dashboard',
            'breadcrumb' => 'Index',
            'help_url' => '/help',
        ]);
    })->name('home');

    Route::get('/dashboard', function () {
        return view('dashboard', [
            'title' => 'Dashboard',
            'breadcrumb' => 'Index',
            'help_url' => '/help',
        ]);
    })->name('dashboard');

    Route::controller(MenuController::class)->group(function () {
        Route::get('/menu', 'index')->name('menu');
        Route::post('/addMenu', 'addMenu')->name('addMenu');
    });

    Route::controller(SettingController::class)->group(function () {
        Route::get('/settings', 'index')->name('settings');
    });
    Route::controller(CookieController::class)->group(function () {
        Route::post('/setPrivacyPolicyCookie', 'setPrivacyPolicyCookie')->name('setPrivacyPolicyCookie');
    });

    Route::controller(PermissionsController::class)->group(function () {
        Route::get('/permission', 'index')->name('permission');
        Route::post('/addPermission', 'addPermission')->name('addPermission');
        Route::delete('/deletePermission', 'deletePermission')->name('deletePermission');

    });

    Route::prefix('chat')->controller(ChatController::class)->group(function () {
        Route::get('/', 'index')->name('chat');
        Route::get('/getUserChat', 'getUserChat')->name('getUserChat');
        Route::patch('/delChatMsg', 'delChatMsg')->name('delChatMsg');
        Route::patch('/seenChatMsg', 'seenChatMsg')->name('seenChatMsg');
        Route::post('/sendMsg', 'sendMsg')->name('sendMsg');
        Route::get('/getchatUserList', 'getchatUserList')->name('getchatUserList');
        Route::get('/getchatContactList', 'getchatContactList')->name('getchatContactList');


    });


    Route::prefix('helpdesk')->controller(HelpdeskController::class)->group(function () {
        Route::get('/', 'index')->name('helpdesk');
        Route::get('/add', 'addticket')->name('addticket');
        Route::get('/ticket/{ticketno}', 'viewticket')->name('viewticket');
        Route::get('/getHelpdeskClients', 'getHelpdeskClients')->name('getHelpdeskClients');
        Route::post('/addClient', 'addClient')->name('helpdeskAddClient');
        Route::get('/getHelpdeskProjects', 'getHelpdeskProjects')->name('getHelpdeskProjects');
        Route::get('/getHelpdeskStatus', 'getHelpdeskStatus')->name('getHelpdeskStatus');
        Route::get('/getHelpdeskCategory', 'getHelpdeskCategory')->name('getHelpdeskCategory');
        Route::post('/addCategory', 'addCategory')->name('helpdeskAddCategory');
        Route::get('/getHelpdeskPriority', 'getHelpdeskPriority')->name('getHelpdeskPriority');
        Route::get('/getHelpdeskAssigneeList', 'getHelpdeskAssigneeList')->name('getHelpdeskAssigneeList');
        Route::post('/addProject', 'addProject')->name('helpdeskAddProject');
        Route::post('/addPriority', 'addPriority')->name('helpdeskAddPriority');
        Route::post('/addStatus', 'addStatus')->name('helpdeskAddStatus');
        Route::post('/addHelpdeskTicket', 'addHelpdeskTicket')->name('addHelpdeskTicket');
        Route::get('/ticket/file/{id}', 'downloadFile')->name('downloadFile');
        Route::post('/addComment', 'addComment')->name('addComment');
        Route::post('/updateStatus', 'updateStatus')->name('helpdeskUpdateStatus');
        Route::post('/helpdeskUploadImg', 'helpdeskUploadImg')->name('helpdeskUploadImg');
        Route::post('/updateAssignee', 'updateAssignee')->name('helpdeskUpdateAssignee');
        Route::delete('/ticket/delattachment/{id}', 'deleteAttachment')->name('helpdeskDeleteAttachment');



    });

    Route::controller(NotificationController::class)->group(function () {
        Route::patch('/notification/read/{id}', 'MarkAsRead')->name('notification.read');
        Route::patch('/notification/unread/{id}', 'MarkAsUnread')->name('notification.unread');
        Route::patch('/notification/markallread', 'markAllRead')->name('notification.markallread');
    });

    Route::resource('users', UserController::class)->except(['destroy']);
    Route::controller(UserController::class)->group(function () {
       Route::delete('/deleteUser', 'deleteUser')->name('deleteUser');
       Route::get('/testevent', 'testevent')->name('testevent');
       Route::get('/user-export', 'userexport')->name('user-export');
    });

    // Route::resource('roles', RoleController::class);
    Route::controller(RoleController::class)->group(function () {
        Route::get('/roles', 'index')->name('roles.index');
        Route::get('/roles/edit', 'edit')->name('roles.edit');
        Route::patch('/roles', 'update')->name('roles.update');
        Route::post('/roles', 'store')->name('roles.store');
        Route::delete('/roles', 'destroy')->name('roles.destroy');
    });


    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'index')->name('profile.index');
        Route::get('/profile/edit', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });
});

require __DIR__ . '/auth.php';
