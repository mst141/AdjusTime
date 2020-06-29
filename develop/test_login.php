<?php
session_start();

if(isset($_POST["login"])) {
	if($_POST["user_name"] == "webtan" && $_POST["password"] == "webtan_pass") {
		$_SESSION["user_name"] = $_POST["user_name"];
		$login_success_url = "success.php";
		header("Location: {$login_success_url}");
		exit;
	}else{
		$alert = "<script type='text/javascript'>
		alert('ユーザー名またはパスワードを見直してください。');</script>";
		echo $alert;
	}
}
?>

<form action="" method="POST">
	<p>ログインID：<input type="text" name="user_name"></p>
	<p>パスワード：<input type="password" name="password"></p>
	<input type="submit" name="login" value="ログイン">
</form>