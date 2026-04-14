<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\ProductoAdminController;
use App\Http\Controllers\Admin\CategoriaAdminController;
use App\Http\Controllers\Usuario\CatalogoController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

/**
 * Dashboard "inteligente"
 * - Admin -> /admin/dashboard
 * - Usuario -> /usuario/dashboard
 *
 * OJO: aquí NO usamos verified (si lo quieres, te digo cómo agregarlo sin romper roles)
 */
Route::middleware(['auth'])->get('/dashboard', function () {

    // Si tu middleware rol funciona, lo más seguro es leer el campo "rol"
    // Ajusta el nombre del campo si se llama diferente (role, tipo, etc.)
    $rol = auth()->user()->rol ?? null;

    if ($rol === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('usuario.dashboard');
})->name('dashboard');


/**
 * Perfil (cualquier usuario autenticado)
 */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/**
 * ADMIN
 */
Route::middleware(['auth', 'rol:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::view('/dashboard', 'admin.dashboard')->name('dashboard');

        Route::resource('productos', ProductoAdminController::class);
        Route::resource('categorias', CategoriaAdminController::class);
    });


/**
 * USUARIO
 */
// USUARIO: una sola vista (dashboard = catálogo)
Route::middleware(['auth', 'rol:usuario'])
    ->prefix('usuario')
    ->name('usuario.')
    ->group(function () {

        // una sola pantalla
        Route::get('/dashboard', [CatalogoController::class, 'index'])->name('dashboard');

        // opcional: detalle
        Route::get('/productos/{producto}', [CatalogoController::class, 'show'])->name('productos.show');
    });
require __DIR__ . '/auth.php';