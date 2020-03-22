<?php
    //ユーザー新規登録
    if(isset($_POST['signin'])){
        $username = $_POST['username'];
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];
        try{
            $db = new PDO('mysql:host=localhost;dbname=SCHEDULE','root','root');
            $sql = 'INSERT INTO USERS(username, password1, password2) VALUES(?, ?, ?)';
            $stmt = $db->prepare($sql);
            $stmt->execute(array($username, $password1, $password2));
            $stmt = null;
            $db = null;
            //登録後ログイン画面に遷移
            header('Location: http://192.168.33.10/AdjusTime/LogIn.php');
            exit;
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
            <p>新規登録</p>
            <form action="" name="SignForm" method="POST">
                ユーザー名<br><input type="text" name="username" value=""><br>
                パスワード<br><input type="password" name="password1" value=""><br>
                パスワード(確認用) <br><input type="password" name="password2" value=""><br><br>
                <input type="submit" class="btn-flat-border" name="signin" value="SIGN IN">
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