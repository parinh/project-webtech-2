<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController; //ต้องทำตรงนี้ก่อนถึงจะใช้ controller ได้
use App\Http\Controllers\PostsController;

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
    return redirect()->route('posts.index');
});

Route::get('/page',[PagesController::class,'index'])//อีกวิธีในการ route หน้า มันจะใช้ controller แทน ก็คือต้องสร้าง controller ก่อน แล้วก็บอกว่าจะใช้ class controller อะไร แล้วก็ใช้ action ไหน
    ->name('pages.index');
//Route::get('/pages',function (){ //เวลา url มี /pages มาก็จะทำตามข้างล่างต่อ
    //return view('pages.index'); //ไปเรียกใช้ index ในโฟลเดอร์ page
//})->name('pages.index'); //ตั้งชื่อให้ เพื่อจะได้เอาไปเรียกเวลา link หน้า

Route::put('/attachmentUpdate/{id}',[PostsController::class,'attachmentUpdate'])
    ->name('posts.attachmentUpdate');

Route::post('/createComment/{id}',[PostsController::class,'createComment'])
    ->name('posts.createComment');


Route::get('/pages/test-file', [PagesController::class, 'test_file']);


Route::get('/pages/{id}',[PagesController::class,'show']) //เหมือนข้างบนแต่ว่ารับค่าแล้วส่งไป controller ด้วย
    ->name('pages.show');


Route::resource('/posts',\App\Http\Controllers\PostsController::class); //บอกตีวเดียวรวมๆเลย มันใช้ action ได้ทุกตัวเลย

Route::resource('/attachments',\App\Http\Controllers\AttachmentController::class);


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');
