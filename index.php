<?php

$config = './core/config/systemConfig.php';

if (file_exists($config)) {
    require $config;
    //Route::startApp();
} else {
    echo 'Not install system';
}