<?php

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

// Route::get('/', function () {
//     return view('home');
// });
// Route::get('/home', function () {
//     return view('home');
// });
Route::get('/about', function () {
    return view('aboutUs');
})->name('about');

Route::get('/', [App\Http\Controllers\MainController::class, 'home']);
Route::get('/home', [App\Http\Controllers\MainController::class, 'home'])->name('home');

// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
Route::get('login/{provider}', [App\Http\Controllers\Auth\LoginController::class, 'redirectToProvider']);
Route::get('login/{provider}/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleProviderCallback']);

//navbar pages
Route::get('priceList', [App\Http\Controllers\PriceController::class, 'showPrices'])->name('priceList');
Route::post('search', [App\Http\Controllers\MainController::class, 'search'])->name('search');

Route::GET('lesson/{id}', [App\Http\Controllers\LessonController::class, 'showLesson'])->name('showLesson');
Route::GET('lector/{id}', [App\Http\Controllers\LessonController::class, 'showLector'])->name('showLector');


// form admin only
Route::get('admin/languages', [App\Http\Controllers\Admin\EditInfo::class, 'getLanguages'])->name('languages');
Route::get('admin/lessons', [App\Http\Controllers\Admin\EditInfo::class, 'getLessons'])->name('lessons');
Route::get('admin/prices', [App\Http\Controllers\Admin\EditInfo::class, 'getPrices'])->name('prices');
Route::get('admin/lectors', [App\Http\Controllers\LectorController::class, 'showLectors'])->name('lectors');
Route::get('admin/newLector', [App\Http\Controllers\LectorController::class, 'NewLector'])->name('newLector');
Route::POST('admin/addLector', [App\Http\Controllers\LectorController::class, 'AddLector'])->name('addLector');
Route::GET('admin/lectorData/{id}', [App\Http\Controllers\LectorController::class, 'getLector'])->name('getLector');
Route::GET('admin/getSetup/{id}', [App\Http\Controllers\CalendarController::class, 'GetSetup'])->name('getSetup');
Route::GET('getCalendar/{id}', [App\Http\Controllers\CalendarController::class, 'GetCalendar'])->name('getCalendar');
Route::GET('admin/addLesson', [App\Http\Controllers\LessonController::class, 'index'])->name('addLesson');
Route::POST('admin/addLessonDB', [App\Http\Controllers\LessonController::class, 'addLesson'])->name('addLessonDB');


Route::POST('lector/AddSetup', [App\Http\Controllers\CalendarController::class, 'AddSetup'])->name('AddSetup');
Route::post('/payment/status', [App\Http\Controllers\PaymentController::class, 'status'])->name('payment'); 
Route::get('/payment/make', [App\Http\Controllers\PaymentController::class, 'transaction'])->name('transaction'); 
