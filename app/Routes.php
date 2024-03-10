<?php

// This file is optional for defining routes (you can define them directly in Router.php if preferred)

return [
    "/home" => "App\Controllers\HomeController@index",
    '/' => 'App\Controllers\HomeController@index',
    '/signup' => 'App\Controllers\HomeController@signup',
    '/artist-details' => 'App\Controllers\HomeController@artistDetails',
    '/about-us' => 'App\Controllers\AboutUsController@index',
    '/contact-us' => 'App\Controllers\ContactUsController@index',
    // Add more routes as needed
];
