<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

// Dynamic route for all photox views
Route::get('/{page}', function ($page) {
    $view = preg_replace('/\.html$/', '', $page);
    if (view()->exists($view)) {
        return view($view);
    }
    abort(404);
})->where('page', '^[a-zA-Z0-9_\-\/]+(\.html)?$');
