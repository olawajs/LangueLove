<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
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
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/thankYou', function () {
    return view('thankYou');
})->name('thankYou');


Route::post('/payment/useLessons', [App\Http\Controllers\PaymentController::class, 'useLessons'])->name('useLessons'); 
Route::get('myCalendar', [App\Http\Controllers\MainController::class, 'myCalendar'])->name('myCalendar'); 
Route::get('myAccount', [App\Http\Controllers\MainController::class, 'myAccount'])->name('myAccount'); 
Route::get('signIn', [App\Http\Controllers\NewsletterController::class, 'signIn'])->name('signIn'); 
Route::get('signOff', [App\Http\Controllers\NewsletterController::class, 'signOff'])->name('signOff'); 
Route::post('checkCode', [App\Http\Controllers\NewsletterController::class, 'checkCode'])->name('checkCode'); 
Route::get('/', [App\Http\Controllers\MainController::class, 'home']);
Route::get('/home', [App\Http\Controllers\MainController::class, 'home'])->name('home');
Route::post('sendConsultation', [App\Http\Controllers\MainController::class, 'sendConsultationMail'])->name('sendConsultation'); 
Route::post('sendCompany', [App\Http\Controllers\MainController::class, 'sendCompanyMail'])->name('sendCompany'); 
Route::get('consultation', [App\Http\Controllers\MainController::class, 'showForm'])->name('consultation'); 
Route::get('forCompanies', [App\Http\Controllers\MainController::class, 'showForm2'])->name('forCompanies'); 
Route::get('getMyCalendar', [App\Http\Controllers\CalendarController::class, 'myCalendar'])->name('getMyCalendar'); 
// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::GET('deleteAccount', [App\Http\Controllers\MainController::class, 'deleteAccount'])->name('deleteAccount');

// Strony dla lektorów
Route::get('toAccept', [App\Http\Controllers\CalendarController::class, 'acceptLessons'])->name('toAccept'); 
Route::get('accept/{id}', [App\Http\Controllers\CalendarController::class, 'accept'])->name('accept'); 

// 
Auth::routes();


Route::get('test', [App\Http\Controllers\Admin\EditInfo::class, 'Test'])->name('test');
Route::get('admin/languages', [App\Http\Controllers\Admin\EditInfo::class, 'getLanguages'])->name('languages');
Route::get('login/{provider}', [App\Http\Controllers\Auth\LoginController::class, 'redirectToProvider']);
Route::get('login/{provider}/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleProviderCallback']);

//navbar pages
Route::get('priceList', [App\Http\Controllers\PriceController::class, 'showPrices'])->name('priceList');
Route::post('search', [App\Http\Controllers\MainController::class, 'search'])->name('search');
Route::get('priceList/search/{lang}/{type}', [App\Http\Controllers\MainController::class, 'searchPricelist'])->name('searchPricelist');

Route::GET('lesson/{id}', [App\Http\Controllers\LessonController::class, 'showLesson'])->name('showLesson');
Route::GET('lector/{id}', [App\Http\Controllers\LessonController::class, 'showLector'])->name('showLector');
Route::GET('activate/{mail}', [App\Http\Controllers\MainController::class, 'activate'])->name('activate');
Route::GET('generateCode', [App\Http\Controllers\NewsletterController::class, 'generateCode'])->name('generateCode');

// form admin only

Route::get('admin/lessons', [App\Http\Controllers\Admin\EditInfo::class, 'getLessons'])->name('lessons');
Route::get('admin/data', [App\Http\Controllers\Admin\AdministratorController::class, 'Database'])->name('database');
Route::get('admin/prices', [App\Http\Controllers\Admin\EditInfo::class, 'getPrices'])->name('prices');
Route::get('admin/lectors', [App\Http\Controllers\LectorController::class, 'showLectors'])->name('lectors');
Route::get('admin/newLector', [App\Http\Controllers\LectorController::class, 'NewLector'])->name('newLector');
Route::POST('admin/addLector', [App\Http\Controllers\LectorController::class, 'AddLector'])->name('addLector');
Route::POST('admin/editLector', [App\Http\Controllers\LectorController::class, 'EditLector'])->name('editLector');
Route::POST('admin/editLevel', [App\Http\Controllers\LectorController::class, 'EditLevel'])->name('editLevel');
Route::GET('admin/lectorData/{id}', [App\Http\Controllers\LectorController::class, 'getLector'])->name('getLector');
Route::GET('admin/getSetup/{id}', [App\Http\Controllers\CalendarController::class, 'GetSetup'])->name('getSetup');
Route::GET('getCalendar/{id}', [App\Http\Controllers\CalendarController::class, 'GetCalendar'])->name('getCalendar');
Route::GET('admin/addLesson', [App\Http\Controllers\LessonController::class, 'index'])->name('addLesson');
Route::POST('admin/addLessonDB', [App\Http\Controllers\LessonController::class, 'addLesson'])->name('addLessonDB');


Route::POST('lector/AddSetup', [App\Http\Controllers\CalendarController::class, 'AddSetup'])->name('AddSetup');
Route::get('/payment/validate', [App\Http\Controllers\PaymentController::class, 'getReturn'])->name('payment'); 
Route::post('/payment/status', [App\Http\Controllers\PaymentController::class, 'status'])->name('status'); 

Route::post('/payment/make', [App\Http\Controllers\PaymentController::class, 'transaction'])->name('transaction'); 

Route::post('/payment/buy', [App\Http\Controllers\PaymentController::class, 'buyLesson'])->name('buyLesson'); 

Route::get('searchLessons/{type}', [App\Http\Controllers\MainController::class, 'search2'])->name('searchLessons');

//dla maili
Route::get('/email', function () {
    // Mail::to('olawjs@gmail.com')->send(new WelcomeMail());
    return new WelcomeMail();
});

// test
Route::GET('lectorTest/{id}', [App\Http\Controllers\Admin\AdministratorController::class, 'showLector']);
