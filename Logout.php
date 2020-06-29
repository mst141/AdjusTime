<?php
    session_start();
    session_destroy();
    echo "ログアウトしました<a href='Login.php'>ログイン画面へ";
?>