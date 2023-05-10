<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;

Route::get('/comments', [CommentController::class, 'index']);
Route::post('/comments', [CommentController::class, 'store']);

?>
