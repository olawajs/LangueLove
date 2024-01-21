<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LanguageController;
use App\Http\Controllers\Api\LessonTypeController;
use App\Http\Controllers\Api\PriceTypeController;
use App\Http\Controllers\Api\PriceController;
use App\Http\Controllers\Api\LessonDurationController;
use App\Http\Controllers\Api\DiscountPacketController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('languages', LanguageController::class);
Route::resource('lesson_types', LessonTypeController::class);
Route::resource('price_types', PriceTypeController::class);
Route::resource('prices', PriceController::class);
Route::resource('lesson_durations', LessonDurationController::class);
Route::resource('packets', DiscountPacketController::class);

Route::post('count', [App\Http\Controllers\MainController::class, 'count'])->name('count');
Route::post('Paymentprice', [App\Http\Controllers\MainController::class, 'Paymentprice'])->name('Paymentprice');
Route::post('Packetprice', [App\Http\Controllers\MainController::class, 'Packetprice'])->name('Packetprice');
Route::post('validTermins', [App\Http\Controllers\MainController::class, 'validTermins'])->name('validTermins');
Route::post('checkBank', [App\Http\Controllers\MainController::class, 'checkBank'])->name('checkBank');
Route::post('DeleteTerm', [App\Http\Controllers\CalendarController::class, 'DeleteTerm'])->name('DeleteTerm');