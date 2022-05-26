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
Route::controller(RegisterController::class)->group(function(){

    Route::post('register', 'register');
    Route::post('login', 'login');

});

//Public Route API Category
Route::controller(CatagoryController::class)->group(function(){
    Route::resource('category', CatagoryController::class);
    Route::get('subcategory', [CatagoryController::class, 'queryCategoryDesign']);
});

//Public Route API Post
Route::controller(PostController::class)->group(function() {
    Route::post('/posts', [PostController::class, 'index']);
    Route::get('/posts/{id}', [PostController::class, 'show']);

});

//Public Route API Comment
Route::controller(CommentController::class)->group(function() {
    Route::post('/comment', [CommentController::class, 'index']);
    Route::get('/comment{id}',[CommentController::class, 'show']);
    // Route::get('/comment{id}',[CommentController::class, 'show']);

});
        

// Protect
Route::middleware('auth:sanctum')->group( function () {
    Route::post('/posts/create', [PostController::class, 'store']);
    Route::post('/comment/create', [CommentController::class, 'store']);
});