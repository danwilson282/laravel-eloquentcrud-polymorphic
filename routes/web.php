<?php

use Illuminate\Support\Facades\Route;
use App\Models\Staff;
use App\Models\Photo;
use App\Models\Product;

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
Route::get('/create/staff', function () {
    $staff = Staff::find(1);
    $staff->photos()->create(['path'=>'example.jpg']);
});
Route::get('/create/product', function () {
    $product = Product::find(1);
    $product->photos()->create(['path'=>'product.jpg']);
});
Route::get('/read', function () {
    $staff = Staff::findOrFail(1);
    foreach($staff->photos as $photo){
        return $photo->path;
    }
});
Route::get('/update', function () {
    $product = Product::find(1);
    $photo = $product->photos()->whereId(2)->first();
    $photo->path = "updated.jpg";
    $photo->save();
});
Route::get('/delete', function () {
    $staff = Staff::findOrFail(1);
    $staff->photos()->whereId(1)->delete();
});
Route::get('/assign', function () {
    $staff = Staff::findOrFail(1);
    //new unassigned photo
    $photo = Photo::findOrFail(5);
    $staff->photos()->save($photo);
});
Route::get('/unassign', function () {
    $staff = Staff::findOrFail(1);
    $staff->photos()->whereId(5)->update(['imageable_id'=>'0', 'imageable_type'=>'']);
    
});
