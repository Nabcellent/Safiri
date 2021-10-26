<?php

/*+++ +++ +++ --- --- ---  +++ +++ +++ --- --- ---  +++ +++ +++ --- --- ---  +++ +++ +++ --- --- ---  USER TYPES  */

use Illuminate\Support\Facades\Auth;

if(!function_exists('isAdmin')) {
    function isAdmin(): bool {
        return in_array(Auth::user()->is_admin, [true, 7]);
    }
}
if(!function_exists('isRed')) {
    function isRed(): bool {
        return Auth::user()->is_admin === "7";
    }
}
