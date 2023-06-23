<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Landing\ComponentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Backend\Component\DescriptionController;
use App\Models\Description;

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
    $data = [
        'description' => Description::get(),
    ];
    return view('welcome', $data);
});

// Route::get('/', function () {
//     return view('landing_page');
// });


Auth::routes();



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/landing/component/move', [ComponentController::class, 'move_component'])->name('component.move');
Route::post('/landing/component/add', [ComponentController::class, 'add_component'])->name('component.add');
Route::get('/landing/component/{componentid?}', [ComponentController::class, 'index'])->name('component.content');
Route::post('/landing/component/get_content', [ComponentController::class, 'get_content'])->name('component.get_content');
Route::post('/landing/component/edit_content', [ComponentController::class, 'edit_content'])->name('component.edit_content');
Route::post('/landing/component/create_content', [ComponentController::class, 'create_content'])->name('component.create_content');

Route::get('/backend/description', [DescriptionController::class, 'index'])->name('backend.description');
Route::get('/backend/create/description', [DescriptionController::class, 'create'])->name('backend.description.create');
Route::post('/backend/create/description', [DescriptionController::class, 'store'])->name('backend.description.create.process');
Route::get('/backend/edit/description/{id?}', [DescriptionController::class, 'edit'])->name('backend.description.edit');
Route::post('/backend/edit/description/{id?}', [DescriptionController::class, 'edit_process'])->name('backend.description.edit.process');
Route::delete('/backend/delete/description/{id?}', [DescriptionController::class, 'destroy'])->name('backend.description.delete');