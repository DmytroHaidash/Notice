<?php

use Illuminate\Support\Str;

/**
 * @return Closure
 */
if (!function_exists('filenameSanitizer')) {
    function filenameSanitizer(): Closure
    {
        return function ($fileName) {
            $name = pathinfo($fileName, PATHINFO_FILENAME);
            $ext = pathinfo($fileName, PATHINFO_EXTENSION);
            return Str::slug($name) . '.' . $ext;
        };
    }
}

if (!function_exists('stripPhone')) {
    /**
     * @param string $number
     * @return string|string[]
     */
    function stripPhone(string $number)
    {
        return str_replace(['(', ')', '-', ' '], '', $number);
    }
}
