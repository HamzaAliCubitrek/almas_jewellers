<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\GoldSheetController;
use App\Http\Controllers\karatController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/clear-cache', function () {
    Artisan::call('optimize:clear');
    return 'Application cache has been cleared';
});

Auth::routes();

Route::get('/', function () {
    if (Auth::check()) {
        // return redirect()->route('dashboard');
        return redirect()->route('home');
    }
    return view('auth.login');
})->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('permissions', PermissionController::class);
    Route::resource('users', UserController::class);

    //edit Profile controllers
    Route::get('view-profile', [UserController::class, "viewProfile"]);
    Route::get('/edit-profile/{id}', [UserController::class, "editProfile"])->name('edit-profile');
    Route::post('update-profile/{id}', [UserController::class, "updateProfile"])->name('update-profile');
    Route::post('change-password', [UserController::class, "changePassword"]);

    //role routes
    Route::controller(RoleController::class)->group(
        function () {
            Route::get('roles/', 'index');
            Route::get('roles/create', 'create');
            Route::post('roles/store', 'store');
            Route::post('roles/destroy/{id}', 'destroy');
            Route::get('roles/edit/{id}', 'edit');
            Route::get('roles/show/{id}', 'show');
        }
    );

    //items routes
    Route::controller(ItemsController::class)->group(
        function () {
            Route::get('items/', 'index');
            Route::get('items/create', 'create');
            Route::post('items/store', 'store');
            Route::post('items/destroy/{id}', 'destroy');
            Route::get('items/edit/{id}', 'edit');
            Route::get('items/show/{id}', 'show');
            // Route::get('items/print/{id}', 'print');
        }
    );

    Route::controller(TypeController::class)->group(
        function () {
            Route::get('types', 'index');
            Route::get('types/create', 'create');
            Route::post('types/store', 'store');
            Route::get('types/edit/{id}', 'edit');
        }
    );

    Route::controller(CategoriesController::class)->group(
        function () {
            Route::get('categories', 'index');
            Route::get('categories/create', 'create');
            Route::post('categories/store', 'store');
            Route::get('categories/edit/{id}', 'edit');
            Route::post('categories/destroy/{id}', 'destroy');
        }
    );

    Route::controller(GoldSheetController::class)->group(
        function () {
            Route::get('sheet', 'index');
            Route::get('sheet/create', 'create');
            Route::post('sheet/store', 'store');
            Route::get('sheet/edit/{id}', 'edit');

            Route::post('sheet/destroy/{id}', 'destroy');
            Route::get('sheet/test', 'test');
            // Route::post('sheet/test', 'test');

        }
    );
    Route::controller(karatController::class)->group(
        function () {
            Route::get('karat', 'index');
            Route::get('karat/create', 'create');
            Route::post('karat/store', 'store');
            Route::get('karat/edit/{id}', 'edit');
            Route::post('karat/destroy/{id}', 'destroy');
        }
    );

    Route::get('qrcode-with-color', function () {
        $path = public_path('qrcode/' . time() . '.png');

        return QrCode::size(300)
            ->generate('A simple example of QR code', $path);
    });
});

Route::get('items/print/{id}',  [ItemsController::class, 'print']);
Route::get('sheet/show/{id}', [GoldSheetController::class, 'show']);
Route::get('sheet/showpublic', [GoldSheetController::class, 'publicSheet']);

Route::get('items/public', [ItemsController::class, 'publicview']);
Route::POST('items/verify', [ItemsController::class, 'verifyproduct']);
