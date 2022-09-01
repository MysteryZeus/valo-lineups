<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'core/App.php';
require_once 'core/Controller.php';
require_once 'core/Model.php';
require_once 'core/Database.php';

if (!Database::connect()) {
    echo Database::$exception->getMessage();
}
$app = new App;

Database::close();