<?php
/**
 * Created by PhpStorm.
 * User: segun
 * Date: 6/6/17
 * Time: 7:10 PM
 */



define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'cpdp');

session_start();

function db_connect(){
    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    return $con;
}

$con = db_connect();

ob_start();
ob_flush();
