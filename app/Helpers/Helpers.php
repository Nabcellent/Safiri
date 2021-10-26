<?php

/*+++ +++ +++ --- --- ---  +++ +++ +++ --- --- ---  +++ +++ +++ --- --- ---  +++ +++ +++ --- --- ---  USER TYPES  */
if(!function_exists('isAdmin')) {
    function isAdmin(): bool {
        return in_array(Auth::user()->is_admin, [true, 7]);
    }
}
if(!function_exists('isRed')) {
    dd();
    function isRed(): bool {
        return Auth::user()->is_admin === "7";
    }
}
