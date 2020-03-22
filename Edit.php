<?php
    //CREATE_INFOを初期値に利用
    $id = $_GET['id'];
    $db = new PDO('mysql:host=localhost;dbname=SCHEDULE','root','root');
    $sql = 'SELECT * FROM CREATE_INFO WHERE id = :id';
    $stmt = $db->prepare($sql);
    $stmt -> execute([':id' => $id]);
    $result = $stmt->fetch(PDO::FETCH_OBJ);

    //更新処理
    if(isset($_POST['Band']) && ($_POST['StarTime']) && ($_POST['Song1']) && ($_POST['Song2']) && ($_POST['EndTime'])){
        $Band = $_POST['Band'];
        $StarTime = $_POST['StarTime'];
        $Song1 = $_POST['Song1'];
        $Song2 = $_POST['Song2'];
        $EndTime = $_POST['EndTime'];
        try{
            $db = new PDO('mysql:host=localhost;dbname=SCHEDULE','root','root');
            $sql = 'UPDATE CREATE_INFO SET Band = :Band, StarTime = :StarTime, Song1 = :Song1, Song2 = :Song2, EndTime = :EndTime WHERE id=:id';
            $stmt = $db->prepare($sql);
            $stmt -> execute([':Band'=> $Band,':StarTime'=> $StarTime,':Song1'=> $Song1,':Song2'=> $Song2,':EndTime'=> $EndTime, ':id'=> $id ]);
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            header('Location: http://192.168.33.10/AdjusTime/Schedule.php');
            exit;    
        }catch(PDOException $e){
            echo $e->getMessage();
            exit;
        }
    }
?>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<div class="container">
    <div class="card-header">
       <h2 class="head-edit">バンド編集</h2>
    </div>
    <div class="card-body">
        <form action="" method="POST">
            <!-- <div class="form-group">
                No
                <input type="text" name="id" class="form-control">
            </div> -->
            <div class="form-group">
                バンド名
                <input value="<?= $result->Band; ?>" type="text" name="Band" class="form-control">
            </div>
            <div class="form-group">
                開始時刻
                <input value="<?= $result->StarTime; ?>" type="text" name="StarTime" class="form-control">
            </div>
            <div class="form-group">
                曲1
                <input value="<?= $result->Song1; ?>" type="text" name="Song1" class="form-control">
            </div>
            <div class="form-group">
                曲2
                <input value="<?= $result->Song2; ?>" type="text" name="Song2" class="form-control">
            </div>
            <div class="form-group">
                終了時刻
                <input value="<?= $result->EndTime; ?>" type="text" name="EndTime" class="form-control">
            </div>

            <div class="col-12 clearfix">
                <div class="float-right test-box">
                    <div class="btn-toolbar mb-3" role="toolbar">
                        <div class="btn-group mr-2" role="group">
                            <button type="button" class="btn btn-primary" onclick="history.back()">戻る</button>
                        </div>
                        <div class="input-group">
                            <button type="submit" href="Schedule.php<? $result['id'] ?>" name="btnSend" class="btn btn-danger">決定</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

</html>