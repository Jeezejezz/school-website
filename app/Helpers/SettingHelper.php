<?php

if (!function_exists('setting')) {
    function setting($key, $default = null)
    {
        return \App\Models\Setting::get($key, $default);
    }
}

if (!function_exists('settings')) {
    function settings($group)
    {
        return \App\Models\Setting::getByGroup($group);
    }
}
