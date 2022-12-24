<?php

Route::get( '/', function() {
   return view( 'admin.index' );
});

/*
 * مسیر کنترلر رو از فایل زیر اصلاح کردیم
 * App/Providers/RouteServiceProvider
 * برای namespace ادمین یه رشته اضافه کردیم
 */
//Route::resource( 'users', 'UserController' );
//Route::resource( 'permissions', 'PermissionController' );
//Route::resource( 'roles', 'RoleController' );
