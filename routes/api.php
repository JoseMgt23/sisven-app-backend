<?php 

use App\Http\Controllers\api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user',function (Request $request) {
    return $request->user();
});

Route::post('/products', [ProductController::class,'store'])->name('products.store');
Route::get('/products' , [ProductController::class,'index'])->name('products');
Route::delete('/products/{product}', [ProductController::class,'destroy'])->name('products.destroy');
Route::get('/products/{product}',[ProductController::class,'show'])->name('products.show');
Route::put('/products/{product}',[ProductController::class,'update'])->name('products.update');





?>