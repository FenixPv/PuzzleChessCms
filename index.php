<?php

use mfw\Route;

$config = './core/config/systemConfig.php';

if (file_exists($config)) {
    require $config;
    Route::start();
} else {
    echo 'Not install system';
}