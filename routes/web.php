<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

// Public routes
Route::get('/', [JobController::class, 'index'])->name('home');

Route::resource('jobs', JobController::class)->middleware('auth');

Route::post('/jobs/store', [JobController::class, 'store'])->name('Jobs.s')->middleware('auth');

Route::post('/notificatons', [JobController::class, 'notifications'])->name('notifications')->middleware('auth');
Route::post('/notificaton/{notification}/read', [JobController::class, 'notificationMarkAsRead'])->name('notification.read')->middleware('auth');

Route::get('/pending-jobs', [JobController::class, 'pendingJobs'])->name('pending.jobs.index')->middleware('auth');

Route::post('/jobs/{job}/accept', [JobController::class, 'acceptJob'])->name('jobs.accept')->middleware('auth');

Route::post('/jobs/{job}/reject', [JobController::class, 'rejectJob'])->name('jobs.reject')->middleware('auth');

Route::resource('companies', CompanyController::class)->middleware('auth');

Route::resource('application', ApplicationController::class)->middleware('auth');

Route::post('/application/{application}/accept', [ApplicationController::class, 'AcceptApplication'])
    ->name('accept.application')->middleware('auth');

Route::post('/application/{application}/reject', [ApplicationController::class, 'RejectApplication'])
    ->name('application.reject')->middleware('auth');

Route::get('/user/{user}', [UserController::class, 'show'])->name('users.show');

Route::get('/company/{company}/jobs', [CompanyController::class, 'showJobs'])->name('company.jobs.show');

Route::get('job/{job}/application', [JobController::class, 'GetJobApp'])->name('jobs.applications');


// Authentication routes

Route::get('/login', [UserController::class, 'showLoginForm'])->name('login.form');
Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register.form');

Route::post('/login', [UserController::class, 'login'])->name('login');

Route::post('/register', [UserController::class, 'register'])->name('register');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// Dashboard routes (protected)
// Route::prefix('dashboard')->group(function () {
//     // Admin routes
//     Route::prefix('admin')->group(function () {
//         Route::get('/', function () {
//             return view('dashboard.admin.index');
//         });
//         Route::get('/users', function () {
//             return view('dashboard.admin.users');
//         });
//         Route::get('/jobs', function () {
//             return view('dashboard.admin.jobs');
//         });
//         Route::get('/applications', function () {
//             return view('dashboard.admin.applications');
//         });
//     });

//     // Company routes
//     Route::prefix('company')->group(function () {
//         Route::get('/', function () {
//             return view('dashboard.company.index');
//         });
//     });

//     // Job seeker routes
//     Route::prefix('jobseeker')->group(function () {
//         Route::get('/', function () {
//             return view('dashboard.jobseeker.index');
//         });
//     });
// });
