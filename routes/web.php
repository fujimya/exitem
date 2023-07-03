<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Brand;
use App\Http\Controllers\Category;
use App\Http\Controllers\Item;
use App\Http\Controllers\Itemvariant;

Route::get('/brandsgetall', [Brand::class, 'index']);
Route::get('/brandssearch', [Brand::class, 'cari']);
Route::get('/brandsgetbyid/{id}', [Brand::class, 'show']);
Route::post('/brandsadd', [Brand::class, 'store']);
Route::post('/brandsupdate', [Brand::class, 'update']);
Route::get('/brandsdestroy/{id}', [Brand::class, 'destroy']);

Route::get('/categorygetall', [Category::class, 'index']);
Route::get('/categorysearch', [Category::class, 'cari']);
Route::get('/categorygetbyid/{id}', [Category::class, 'show']);
Route::post('/categoryadd', [Category::class, 'store']);
Route::post('/categoryupdate', [Category::class, 'update']);
Route::get('/categorydestroy/{id}', [Category::class, 'destroy']);

Route::get('/itemgetall', [Item::class, 'index']);
Route::get('/itemsearch', [Item::class, 'cari']);
Route::get('/itemgetbyid/{id}', [Item::class, 'show']);
Route::post('/itemadd', [Item::class, 'store']);
Route::post('/itemupdate', [Item::class, 'update']);
Route::get('/itemdestroy/{id}', [Item::class, 'destroy']);

Route::get('/itemvariantgetall', [Itemvariant::class, 'index']);
Route::get('/itemvariantsearch', [Itemvariant::class, 'cari']);
Route::get('/itemvariantgetbyid/{id}', [Itemvariant::class, 'show']);
Route::post('/itemvariantadd', [Itemvariant::class, 'store']);
Route::post('/itemvariantpdate', [Itemvariant::class, 'update']);
Route::get('/itemvariantdestroy/{id}', [Itemvariant::class, 'destroy']);
