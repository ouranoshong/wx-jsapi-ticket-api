<?php
/**
 * Created by PhpStorm.
 * User: hong
 * Date: 08/03/2018
 * Time: 4:20 PM
 */

require __DIR__ . '/../vendor/autoload.php';

$config = new \Wx\Access\Token\Configuration([
    'appID' => 'wx05bd512f34440595',
    'appSecret' => '0ff7a44ab3db2753edb4b47643baaaa6'
]);

$client = new \Wx\Access\Token\Client($config);