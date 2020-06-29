<?php

$username = $_POST['username'];
$password = $_POST['password1'];

//ログイン判定
// try{
    $db = new PDO('mysql:host=localhost;dbname=SCHEDULE','root','root');
    $sql = 'SELECT COUNT(*) FROM USERS WHERE username=? AND password1=?';
    $stmt = $db->prepare($sql);
    $stmt->execute(array($username, $password));
    $result = $stmt->fetch();
    $stmt = null;
    $db = null;
    //ホーム画面に遷移
        if($result[0] != 0){
            // if(isset($_POST['login'])){
            // $username = $_POST['username'];
            // $password = $_POST['password1'];
            // setcookie('username',$username,time()+60*60*7);
            // setcookie('password1',$password,time()+60*60*7);
            // exit;
        if(isset($_POST['login'])){
                session_start();
                $_SESSION['username'] = $username;
                header('Location: dev_Schedule.php');
        }else{
                $alert = "<script type='text/javascript'>
                alert('ユーザー名またはパスワードを見直してください。');</script>";
                echo $alert;
                // header('Location: dev_Login.php');
        }
    }
//     catch(PDOException $e){
//         echo $e->getMessage();
//         // exit;
//     }
// }
?>