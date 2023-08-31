<?php

use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Landing\ComponentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Backend\Component\BiayaController;
use App\Http\Controllers\Backend\Component\CarouselController;
use App\Http\Controllers\Backend\Component\DescriptionController;
use App\Http\Controllers\Backend\Component\GaleryController;
use App\Http\Controllers\Backend\Component\HeaderController;
use App\Http\Controllers\Backend\Component\KeunggulanController;
use App\Http\Controllers\Backend\Component\LocationController;
use App\Http\Controllers\Backend\Component\TestimonyController;
use App\Http\Controllers\Backend\LandingPageController;
use App\Http\Controllers\Backend\LembagaController;

// Categories & Artikel
use App\Http\Controllers\Backend\Component\CategoriesController as CategoriesController;
use App\Http\Controllers\Backend\Component\ArtikelController;

use App\Models\Biaya;
use App\Models\Carousel;
use App\Models\Description;
use App\Models\Galery;
use App\Models\Header;
use App\Models\Keunggulan;
use App\Models\LandingPage;
use App\Models\Location;
use App\Models\Testimony;
use Illuminate\Http\Request;

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

Route::get('/', function (Request $request) {
    $domain = $request->getHttpHost();
        
    $landingPage = LandingPage::where('domain', $domain)->first();

    $idLembaga = $landingPage->id_lembaga;

    $data = [
        'landing' => LandingPage::where('id_lembaga',$idLembaga)->orderBy('id')->get(),
        'header' => Header::where('id_lembaga',$idLembaga)->orderBy('id')->get(),
        'carousel' => Carousel::where('id_lembaga',$idLembaga)->orderBy('id')->get(),
        'description' => Description::where('id_lembaga',$idLembaga)->orderBy('id')->get(),
        'galery' => Galery::where('id_lembaga',$idLembaga)->orderBy('id')->get(),
        'testimony' => Testimony::where('id_lembaga',$idLembaga)->orderBy('id')->get(),
        'location' => Location::where('id_lembaga',$idLembaga)->orderBy('id')->get(),
        'biaya' => Biaya::where('id_lembaga',$idLembaga)->orderBy('id')->get(),
        'keunggulan' => Keunggulan::where('id_lembaga',$idLembaga)->orderBy('id')->get(),
    ];
    return view('welcome', $data);
});

Route::get('/login', [LoginController::class, 'index'])->name('login');

// Route::get('/', function () {
//     return view('landing_page');
// });

Route::middleware(['auth', 'role:admin'])->name('admin.')->prefix('admin')->group(function() {
    Route::get('/', [IndexController::class, 'index'])->name('index');
    Route::resource('/roles', RoleController::class);
    Route::resource('/permissions', PermissionController::class);
});

Auth::routes();



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/landing/component/move', [ComponentController::class, 'move_component'])->name('component.move');
Route::post('/landing/component/add', [ComponentController::class, 'add_component'])->name('component.add');
Route::get('/landing/component/{componentid?}', [ComponentController::class, 'index'])->name('component.content');
Route::post('/landing/component/get_content', [ComponentController::class, 'get_content'])->name('component.get_content');
Route::post('/landing/component/edit_content', [ComponentController::class, 'edit_content'])->name('component.edit_content');
Route::post('/landing/component/create_content', [ComponentController::class, 'create_content'])->name('component.create_content');


Route::get('/backend/landing', [LandingPageController::class, 'index'])->name('backend.landing');
Route::get('/backend/create/landing', [LandingPageController::class, 'create'])->name('backend.landing.create');
Route::post('/backend/create/landing', [LandingPageController::class, 'store'])->name('backend.landing.create.process');
Route::get('/backend/edit/landing/{id?}', [LandingPageController::class, 'edit'])->name('backend.landing.edit');
Route::post('/backend/edit/landing/{id?}', [LandingPageController::class, 'edit_process'])->name('backend.landing.edit.process');
Route::delete('/backend/delete/landing/{id?}', [LandingPageController::class, 'destroy'])->name('backend.landing.delete');


Route::get('/backend/header', [HeaderController::class, 'index'])->name('backend.header');
Route::get('/backend/create/header', [HeaderController::class, 'create'])->name('backend.header.create');
Route::post('/backend/create/header', [HeaderController::class, 'store'])->name('backend.header.create.process');
Route::get('/backend/edit/header/{id?}', [HeaderController::class, 'edit'])->name('backend.header.edit');
Route::post('/backend/edit/header/{id?}', [HeaderController::class, 'edit_process'])->name('backend.header.edit.process');
Route::delete('/backend/delete/header/{id?}', [HeaderController::class, 'destroy'])->name('backend.header.delete');

Route::get('/backend/carousel', [CarouselController::class, 'index'])->name('backend.carousel');
Route::get('/backend/create/carousel', [CarouselController::class, 'create'])->name('backend.carousel.create');
Route::post('/backend/create/carousel', [CarouselController::class, 'store'])->name('backend.carousel.create.process');
Route::get('/backend/edit/carousel/{id?}', [CarouselController::class, 'edit'])->name('backend.carousel.edit');
Route::post('/backend/edit/carousel/{id?}', [CarouselController::class, 'edit_process'])->name('backend.carousel.edit.process');
Route::delete('/backend/delete/carousel/{id?}', [CarouselController::class, 'destroy'])->name('backend.carousel.delete');

Route::get('/backend/description', [DescriptionController::class, 'index'])->name('backend.description');
Route::get('/backend/create/description', [DescriptionController::class, 'create'])->name('backend.description.create');
Route::post('/backend/create/description', [DescriptionController::class, 'store'])->name('backend.description.create.process');
Route::get('/backend/edit/description/{id?}', [DescriptionController::class, 'edit'])->name('backend.description.edit');
Route::post('/backend/edit/description/{id?}', [DescriptionController::class, 'edit_process'])->name('backend.description.edit.process');
Route::delete('/backend/delete/description/{id?}', [DescriptionController::class, 'destroy'])->name('backend.description.delete');

Route::get('/backend/galery', [GaleryController::class, 'index'])->name('backend.galery');
Route::get('/backend/create/galery', [GaleryController::class, 'create'])->name('backend.galery.create');
Route::post('/backend/create/galery', [GaleryController::class, 'store'])->name('backend.galery.create.process');
Route::get('/backend/edit/galery/{id?}', [GaleryController::class, 'edit'])->name('backend.galery.edit');
Route::post('/backend/edit/galery/{id?}', [GaleryController::class, 'edit_process'])->name('backend.galery.edit.process');
Route::delete('/backend/delete/galery/{id?}', [GaleryController::class, 'destroy'])->name('backend.galery.delete');

Route::get('/backend/testimony', [TestimonyController::class, 'index'])->name('backend.testimony');
Route::get('/backend/create/testimony', [TestimonyController::class, 'create'])->name('backend.testimony.create');
Route::post('/backend/create/testimony', [TestimonyController::class, 'store'])->name('backend.testimony.create.process');
Route::get('/backend/edit/testimony/{id?}', [TestimonyController::class, 'edit'])->name('backend.testimony.edit');
Route::post('/backend/edit/testimony/{id?}', [TestimonyController::class, 'edit_process'])->name('backend.testimony.edit.process');
Route::delete('/backend/delete/testimony/{id?}', [TestimonyController::class, 'destroy'])->name('backend.testimony.delete');

Route::get('/backend/location', [LocationController::class, 'index'])->name('backend.location');
Route::get('/backend/create/location', [LocationController::class, 'create'])->name('backend.location.create');
Route::post('/backend/create/location', [LocationController::class, 'store'])->name('backend.location.create.process');
Route::get('/backend/edit/location/{id?}', [LocationController::class, 'edit'])->name('backend.location.edit');
Route::post('/backend/edit/location/{id?}', [LocationController::class, 'edit_process'])->name('backend.location.edit.process');
Route::delete('/backend/delete/location/{id?}', [LocationController::class, 'destroy'])->name('backend.location.delete');

Route::get('/backend/biaya', [BiayaController::class, 'index'])->name('backend.biaya');
Route::get('/backend/create/biaya', [BiayaController::class, 'create'])->name('backend.biaya.create');
Route::post('/backend/create/biaya', [BiayaController::class, 'store'])->name('backend.biaya.create.process');
Route::get('/backend/edit/biaya/{id?}', [BiayaController::class, 'edit'])->name('backend.biaya.edit');
Route::post('/backend/edit/biaya/{id?}', [BiayaController::class, 'edit_process'])->name('backend.biaya.edit.process');
Route::delete('/backend/delete/biaya/{id?}', [BiayaController::class, 'destroy'])->name('backend.biaya.delete');

Route::get('/backend/keunggulan', [KeunggulanController::class, 'index'])->name('backend.keunggulan');
Route::get('/backend/create/keunggulan', [KeunggulanController::class, 'create'])->name('backend.keunggulan.create');
Route::post('/backend/create/keunggulan', [KeunggulanController::class, 'store'])->name('backend.keunggulan.create.process');
Route::get('/backend/edit/keunggulan/{id?}', [KeunggulanController::class, 'edit'])->name('backend.keunggulan.edit');
Route::post('/backend/edit/keunggulan/{id?}', [KeunggulanController::class, 'edit_process'])->name('backend.keunggulan.edit.process');
Route::delete('/backend/delete/keunggulan/{id?}', [KeunggulanController::class, 'destroy'])->name('backend.keunggulan.delete');


//manage backend

Route::get('/backend/lembaga', [LembagaController::class, 'index'])->name('backend.lembaga');
Route::get('/backend/create/lembaga', [LembagaController::class, 'create'])->name('backend.lembaga.create');
Route::post('/backend/create/lembaga', [LembagaController::class, 'store'])->name('backend.lembaga.create.process');
Route::get('/backend/edit/lembaga/{id?}', [LembagaController::class, 'edit'])->name('backend.lembaga.edit');
Route::post('/backend/edit/lembaga/{id?}', [LembagaController::class, 'edit_process'])->name('backend.lembaga.edit.process');
Route::delete('/backend/delete/lembaga/{id?}', [LembagaController::class, 'destroy'])->name('backend.lembaga.delete');

// ROUTE BACKEND CATEGORIES
Route::get('/backend/categories', [CategoriesController::class, 'index'])->name('backend.categories');
Route::get('/backend/create/categories', [CategoriesController::class, 'create'])->name('backend.categories.create');
Route::post('/backend/create/process/categories', [CategoriesController::class, 'create_process'])->name('backend.categories.create.process');
Route::get('/backend/edit/categories/{id?}', [CategoriesController::class, 'edit'])->name('backend.categories.edit');
Route::post('/backend/edit/process/categories/{id?}', [CategoriesController::class, 'edit_process'])->name('backend.categories.process.edit');
Route::delete('/backend/delete/categories/{id?}', [CategoriesController::class, 'destroy'])->name('backend.categories.delete');

// ROUTE BCAKEND ARTIKELS 
Route::get('/backend/artikel', [ArtikelController::class, 'index'])->name('backend.artikel');
Route::get('/backend/create/artikel', [ArtikelController::class, 'create'])->name('backend.create.artikel');
Route::post('/backend/create/process/artikel', [ArtikelController::class, 'create_process'])->name('backend.create.process.artikel');
Route::get('/backend/edit/artikel/{id?}', [ArtikelController::class, 'edit'])->name('backend.edit.artikel');
Route::post('/backend/edit/process/artikel/{id?}', [ArtikelController::class, 'edit_process'])->name('backend.edit.process.artikel');
Route::delete('/backend/delete/artikel/{id?}', [ArtikelController::class, 'destroy'])->name('backend.delete.artikel');