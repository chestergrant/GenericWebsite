<?php
session_start();
if(isset($_SESSION['email'])){
    header('Location: dashboard.php');
    exit();
}
include_once 'views/frontpage.php';
?>
