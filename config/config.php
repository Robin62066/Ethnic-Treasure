<?php
session_start();
$site_live = false;
$config = [];
if ($site_live) {
    // error_reporting(E_ERROR);
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    $config['base_url'] = 'https://ethnictreasures.co.in/';
} else {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    $config['base_url'] = 'http://localhost/ethnic/';
}
$config['admin_folder']  = 'admin';
$config['upload_folder'] = 'assets/uploads';
$config['user_folder']  = 'user';
