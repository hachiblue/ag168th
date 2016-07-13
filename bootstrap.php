<?php
/**
 * Created by PhpStorm.
 * User: p2
 * Date: 6/28/14
 * Time: 11:17 AM
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once 'vendor/autoload.php';
require_once 'private/src/Main/Autoloader.php';

\Main\Autoloader::register();