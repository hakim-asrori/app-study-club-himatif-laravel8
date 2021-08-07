<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Session;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CategoryController;


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

// Login & Register
Route::get('/', [AuthController::class, 'index']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/registration', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/registration', [AuthController::class, 'store']);

// Dashboard
Route::get('/dashboard', function () {
	if (Session::get('id_role')==1) {
		return view('dashboard.admin');
	} elseif (Session::get('id_role')==2) {
		return view('dashboard.lecturer');
	} else {
		return view('dashboard.student');
	}
})->middleware('otentikasi');

// Profile & Password
Route::get('/profile', [ProfileController::class, 'index'])->middleware('check_log');
Route::get('/password', [ProfileController::class, 'password'])->middleware('otentikasi');
Route::patch('/profile', [ProfileController::class, 'update'])->middleware('check_log');
Route::put('/password', [ProfileController::class, 'change'])->middleware('otentikasi');

// Class
Route::get('/class', [ClassController::class, 'index'])->middleware('otentikasi');
Route::get('/class/get', [ClassController::class, 'get'])->middleware('otentikasi');
Route::post('/class/add', [ClassController::class, 'add'])->middleware('otentikasi');
Route::patch('/class/edit', [ClassController::class, 'edit'])->middleware('otentikasi');
Route::delete('/class/del', [ClassController::class, 'del'])->middleware('otentikasi');

// Lecturer
Route::get('/lecturer', [LecturerController::class, 'index'])->middleware('otentikasi');
Route::get('/lecturer/get', [LecturerController::class, 'get'])->middleware('otentikasi');
Route::get('/lecturer/user', [LecturerController::class, 'user'])->middleware('otentikasi');
Route::post('/lecturer/add', [LecturerController::class, 'add'])->middleware('otentikasi');
Route::post('/lecturer/store', [LecturerController::class, 'store'])->middleware('otentikasi');
Route::delete('/lecturer/del', [LecturerController::class, 'del'])->middleware('otentikasi');


// Student
Route::get('/student', [StudentController::class, 'index'])->middleware('otentikasi');
Route::get('/student/get', [StudentController::class, 'get'])->middleware('otentikasi');
Route::delete('/student', [StudentController::class, 'destroy'])->middleware('otentikasi');

// Category
Route::get('/category', [CategoryController::class, 'index'])->middleware('otentikasi');
Route::get('/category/get', [CategoryController::class, 'get'])->middleware('otentikasi');
Route::post('/category/add', [CategoryController::class, 'add'])->middleware('otentikasi');
Route::post('/category/edit', [CategoryController::class, 'edit'])->middleware('otentikasi');
Route::post('/category/del', [CategoryController::class, 'del'])->middleware('otentikasi');