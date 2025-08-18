<?php

if (!function_exists('getRedirectRouteByRole')) {
    function getRedirectRouteByRole($user)
    {
        return match ($user->role) {
            'client' => 'client.home',
            'freelancer' => 'freelancer.dashboard',
            default => 'login',
        };
    }
}
