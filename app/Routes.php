<?php

// This file is optional for defining routes (you can define them directly in Router.php if preferred)

return [
    "/home"  => "App\Controllers\ViewController@index",
    '/' => 'App\Controllers\ViewController@index',
    '/signup' => 'App\Controllers\ViewController@signup',
    '/process-signup' => 'App\Controllers\UserController@signup',
    '/login' => 'App\Controllers\ViewController@login',
    '/artist-details' => 'App\Controllers\ViewController@artistDetails',
    '/aboutUs' => 'App\Controllers\ViewController@aboutUs',
    '/contact-us' => 'App\Controllers\ViewController@contactUs',
    // Add more routes as needed
];
