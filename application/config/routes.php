<?php

/**
 * @package        ATS PHP MVC
 * @author        Atish Chandole
 * @since       31 May 2021
 */

$route['default_controller'] = 'accountController';
$route['user_profile'] = 'profile';
$route['create_account'] = 'accountController/createAccount';
$route['login'] = 'accountController/loginForm';
$route['home'] = 'accountController';
$route['add-fruit'] = 'profile/fruitForm';
$route['user-login'] = 'accountController/userLogin';
$route['fruit-insert'] = 'profile/fruitStore';
$route['edit-fruit/(:any)'] = 'profile/edit_fruit/$1';
