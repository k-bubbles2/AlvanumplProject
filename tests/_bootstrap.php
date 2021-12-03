<?php

use Symfony\Component\Dotenv\Dotenv;

require dirname(__DIR__) . '/vendor/autoload.php';

if (method_exists(Dotenv::class, 'bootEnv')) {
    $dotEnv = (new Dotenv())->usePutenv();
    $dotEnv->loadEnv(dirname(__DIR__).'/.env.test');
}
