<?php
  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\CatagoryController;
  
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
  
//Public Route
Route::controller(CatagoryController::class)->group(function(){

    Route::resource('catagory', CatagoryController::class);
    Route::get('subcategory', [CatagoryController::class, 'queryCategoryDesign']);
   

});

//Public Route API Post
Route::controller(PostController::class)->group(function() {
    Route::get('/posts', [PostController::class, 'index']);
    Route::get('/posts/{id}', [PostController::class, 'show']);

});

        

// Protect Route
Route::middleware('auth:sanctum')->group( function () {
    Route::post('/posts/create', [PostController::class, 'store']);
    Route::resource('/posts', PostController::class);
    Route::resource('comment',CommentController::class);
    
});