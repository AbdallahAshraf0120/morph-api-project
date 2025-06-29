<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\PostController;

Route::get('/posts', [PostController::class, 'index']);
Route::get('/{type}/{id}/comments', [\App\Http\Controllers\Api\CommentController::class, 'show']);