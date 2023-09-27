<?php

if (!function_exists("getCurrentUserId")) {
    function getCurrentUserId()
    {
        return Auth::user()->id;
    }
}
