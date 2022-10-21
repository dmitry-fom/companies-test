<?php

use Laravel\Lumen\Routing\Router;

/** @var Router $router */

$router->group(['prefix' => 'v1/user'], function (Router $router) {

    $router->post('register', 'RegistrationController');
    $router->post('sign-in', 'AuthController@getToken');
    $router->post('logout', 'AuthController@invalidateToken');
    $router->post('recovery-password-request', 'AuthController@recoveryPasswordRequest');
    $router->post('change-password', 'AuthController@changePassword');

    $router->group(['prefix' => 'companies', 'middleware' => ['auth']], function (Router $router) {
        $router->get('/', 'CompanyController@view');
        $router->post('/', 'CompanyController@create');
    });

});
