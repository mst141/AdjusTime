<?php
session_start();

if(!isset($_SESSION["user_name"])) {
    $no_login_url = "login_success.php";
	header("Location: {$no_login_url}");
	exit;
}
?>

Success!