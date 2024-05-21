<?php 

use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\CategoriaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\CustomerController;

Route::middleware('auth:sanctum')->get('/user',function (Request $request) {
    return $request->user();
});

Route::post('/products', [ProductController::class,'store'])->name('products.store');
Route::get('/products' , [ProductController::class,'index'])->name('products');
Route::delete('/products/{product}', [ProductController::class,'destroy'])->name('products.destroy');
Route::get('/products/{product}',[ProductController::class,'show'])->name('products.show');
Route::put('/products/{product}',[ProductController::class,'update'])->name('products.update');



Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
Route::get('/categorias/{categoria}', [CategoriaController::class, 'show'])->name('categorias.show');
Route::put('/categorias/{categoria}', [CategoriaController::class, 'update'])->name('categorias.update');
Route::delete('/categorias/{categoria}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');



Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
Route::get('/customers/{customer}', [CustomerController::class, 'show'])->name('customers.show');
Route::put('/customers/{customer}', [CustomerController::class, 'update'])->name('customers.update');
Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');


?>