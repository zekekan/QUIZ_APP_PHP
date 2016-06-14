<?php
    ob_start();
    session_start();
    require_once 'config.php';
    $stduent_obj = new PHPClasses_Student();
    $stduent_obj->logout();
?>