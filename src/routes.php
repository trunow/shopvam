<?php
Route::resource('products', 'App\Http\Controllers\ProductController', ['middleware' => ['web', 'auth']]);
?>