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

    Route::resource('catagory', CatagoryController::class);
    Route::get('subcategory', [CatagoryController::class, 'queryCategoryDesign']);
    // Route::get('developCategory', [CatagoryController::class, 'queryCategoryDevelopment']);
    // Route::get('maketingCategory', [CatagoryController::class, 'queryCategoryMaketing']);
    // Route::get('softwareCategory', [CatagoryController::class, 'queryCategorySoftware']);
    // Route::get('persernalCategory', [CatagoryController::class, 'queryCategoryPersernal']);
    // Route::get('businessCategory', [CatagoryController::class, 'queryCategoryBusiness']);

});

        

// Protect
Route::middleware('auth:sanctum')->group( function () {
    Route::resource('posts', PostController::class);
    Route::resource('comment',CommentController::class);
    
});