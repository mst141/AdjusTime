<?php
session_start();
    //ログイン機能
    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password1'];
        try{
            $db = new PDO('mysql:host=localhost;dbname=SCHEDULE','root','root');
            $sql = 'SELECT COUNT(*) FROM USERS WHERE username=? AND password1=?';
            $stmt = $db->prepare($sql);
            $stmt->execute(array($username, $password));
            $result = $stmt->fetch();
            $stmt = null;
            $db = null;
            //ホーム画面に遷移
            if($result[0] != 0){
                header('Location: http://192.168.33.10/AdjusTime/Schedule.php');
                exit;
            }else{
                $alert = "<script type='text/javascript'>alert('ユーザー名またはパスワードを見直してください。');</script>";
                echo $alert;
            }
        }catch(PDOException $e){
            echo $e->getMessage();
            exit;
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>AdjusTime</title>
        <link rel="stylesheet" href="./style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
<body>

    <div class="Title">
        <h1>AdjusTime</h1>
    </div>
    <div class="OuterBox">
        <div class="LoginBox">
            <p>ログイン</p>
            <form action="" method="POST">
                ユーザー名<br><input type="text" name="username" value="mst_141"><br>
                パスワード<br><input type="password" name="password1" value=""><br><br>
                <input type="submit" class="btn-flat-border" name="login" value="SIGN IN">
            </form>
            <form action="SignUp.php" method="POST">
                    <div class="SignUpBox">
                        <!--上に1本線を挿入-->
                        <hr>
                        新規登録<br><input type="submit" class="btn-flat-border" value="SIGN UP">
                    </div>
            </form>
        </div>
    </div>

</body>

    <div class="LoginFooter">
        <footer>
            <p>©Copyright Hirofumi Ishii 2020.</p>
        </footer>
    </div>

</html>