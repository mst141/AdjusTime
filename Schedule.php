<?php
    try{
        $db = new PDO('mysql:host=localhost;dbname=SCHEDULE','root','root');
        $sql = 'SELECT * FROM SCHEDULE';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        echo $stmt->execute();
        $stmt = null;
        $db = null;
    }catch(PDOException $e){
        echo $e->getMessage();
        exit;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>AdjusTime</title>
        <link rel="stylesheet" href="./style.css">
    </head>
<body>
    <div class="ScheduleTitle">
        <h1>タイムスケジュール一覧</h1>
    </div>
    <div align="center">
        <table border="1" style="border-collapse: collapse; border-color: #99CC00">
            <tr>
                <th>No.</th>
                <th>バンド名</th>
                <th>開始時刻</th>
                <th>終了時刻</th>
            </tr>
            <tr>
                <td>1</td>
                <td>Band1</td>
                <td>9:00</td>
                <td>9:15</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Band2</td>
                <td>9:20</td>
                <td>9:30</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Band3</td>
                <td>9:35</td>
                <td>9:50</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Band4</td>
                <td>9:55</td>
                <td>10:00</td>
            </tr>
        </table>
    </div>
</body>

<div class="LoginFooter">
    <footer>
        <p>©Copyright Hirofumi Ishii 2020.</p>
    </footer>
</div>

</html>