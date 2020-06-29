<?php
    if(isset($_POST['btnSend'])){
        //$no = $_POST['no'];                     
        $band = $_POST['band'];
        $StarTime = $_POST['StarTime'];
        $song1 = $_POST['song1'];
        $song2 = $_POST['song2'];
        $EndTime = $_POST['EndTime'];
        try{
            $db = new PDO('mysql:host=localhost;dbname=SCHEDULE','root','root');
            $sql = 'INSERT INTO CREATE_INFO(id, Band, StarTime, Song1, Song2, EndTime) VALUES(?, ?, ?, ?, ?, ?)';
            $stmt = $db->prepare($sql);
            if (!$stmt) {
                echo "\nPDO::errorInfo():\n";
                print_r($db->errorInfo());
            }
            $stmt->execute(array($no, $band, $StarTime, $song1, $song2, $EndTime));
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            $stmt = null;
            $db = null;
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
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<div class="container">
    <div class="card-header">
       <h2>バンド追加</h2>
    </div>
    <div class="card-body">
        <form action="" method="POST">
            <!-- <div class="form-group">
                No
                <input type="text" name="no" class="form-control">
            </div> -->
            <div class="form-group">
                バンド名
                <input type="text" name="band" class="form-control">
            </div>
            <div class="form-group">
                開始時刻
                <input type="text" name="StarTime" class="form-control">
            </div>
            <div class="form-group">
                曲1
                <input type="text" name="song1" class="form-control">
            </div>
            <div class="form-group">
                曲2
                <input type="text" name="song2" class="form-control">
            </div>
            <div class="form-group">
                終了時刻
                <input type="text" name="EndTime" class="form-control">
            </div>
            <div class="col-12 clearfix">
                <div class="float-right test-box">
                    <div class="btn-toolbar mb-3" role="toolbar">
                        <div class="btn-group mr-2" role="group">
                            <button type="button" class="btn btn-primary" onclick="history.back()">戻る</button>
                        </div>
                        <div class="input-group">
                        <input type="submit" name="btnSend" class="btn btn-danger" value="追加"> 
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

</html>