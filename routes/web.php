<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

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

Route::get('/', [MainController::class, 'start']);
Route::post('/auth/save',[MainController::class, 'save'])->name('auth.save');
Route::post('/auth/check',[MainController::class, 'check'])->name('auth.check');
Route::get('/auth/logout',[MainController::class, 'logout'])->name('auth.logout');
Route::post('/auth/locations', [MainController::class, 'getLocation']);
Route::post('/auth/years', [MainController::class, 'getYear']);
Route::post('/auth/works', [MainController::class, 'getWork']);
Route::post('/auth/types', [MainController::class, 'getType']);
Route::post('/auth/sources', [MainController::class, 'getSource']);
Route::post('/events', [MainController::class, 'getEvent']);
Route::post('/edit/analysis', [MainController::class, 'editAnalysis']);
Route::post('/edit/extract', [MainController::class, 'editExtract']);
Route::post('/edit/annales', [MainController::class, 'editAnnales']);
Route::post('/edit/report', [MainController::class, 'editReport']);

Route::group(['middleware'=>['AuthCheck']], function() {
    Route::get('/auth/login', [MainController::class, 'login'])->name('auth.login');
    Route::get('/auth/register', [MainController::class, 'register'])->name('auth.register');
    Route::get('/auth/home', [MainController::class, 'home']);
    Route::get('/auth/years', [MainController::class, 'years'])->name('auth.years');
    Route::get('/auth/sources', [MainController::class, 'sources'])->name('auth.sources');
    Route::get('/auth/locations', [MainController::class, 'locations'])->name('auth.locations');
    Route::get('/auth/works', [MainController::class, 'works'])->name('auth.works');
    Route::get('/auth/types', [MainController::class, 'types'])->name('auth.types');
    Route::get('/events', [MainController::class, 'event']);
    Route::get('/edit/analysis', [MainController::class, 'analysis']);
    Route::get('/edit/extract', [MainController::class, 'extract']);
    Route::get('/edit/annales', [MainController::class, 'annales']);
    Route::get('/edit/report', [MainController::class, 'report']);
});
?>

