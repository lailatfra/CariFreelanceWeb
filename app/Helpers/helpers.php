<?php

if (!function_exists('getRedirectRouteByRole')) {
    function getRedirectRouteByRole($user)
    {
        return match ($user->role) {
            'client' => 'client.dashboard',
            'freelancer' => 'freelancer.dashboard',
            default => 'login',
        };
    }
}
