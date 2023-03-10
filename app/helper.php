<?php

// namespace App\helper;
use Illuminate\Support\Str;

if(!function_exists('uuid')){
    function uuid()
    {
        return Str::uuid()->toString();        
    }
}