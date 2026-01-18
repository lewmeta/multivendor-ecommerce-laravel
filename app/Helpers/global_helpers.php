<?php

/** check user has permission */
if (!function_exists('hasPermission')) {
    function hasPermission(array $permissions): bool
    {
        if (auth('admin')->user()->hasRole('Super Admin')) return true;

        return auth('admin')->user()->hasAnyPermission($permissions);
    }
}

/** set sidebar active */

if (!function_exists('setActive')) {
    function setActive(array $routes, $activeClass = 'active'): string
    {
        return request()->routeIs($routes) ? $activeClass : '';
    }
}
