<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;

if (! function_exists('isMenuItemActive') ){
    function isMenuItemActive( $key, $activeClass = 'active' ){
        if ( is_array($key) ){
            return in_array( Route::currentRouteName(), $key ) ? $activeClass : '';
        }

        return Route::currentRouteName() == $key ? $activeClass : '';
    }
}

if (! function_exists('mycurrentUser') ){
    function mycurrentUser(User $user){
        return $user->name;
    }
}
