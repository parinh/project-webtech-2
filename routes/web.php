<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController; //ต้องทำตรงนี้ก่อนถึงจะใช้ controller ได้
use App\Http\Controllers\PostsController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/about',[PagesController::class,'about'])//อีกวิธีในการ route หน้า มันจะใช้ controller แทน ก็คือต้องสร้าง controller ก่อน แล้วก็บอกว่าจะใช้ class controller อะไร แล้วก็ใช้ action ไหน
->name('pages.about');




Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');
