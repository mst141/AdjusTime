<?php
    //表示とページネーション
    try{
        $db = new PDO('mysql:host=localhost;dbname=SCHEDULE','root','root');
        // GETで現在のページ数を取得する（未入力の場合は1）

        $sql = 'SELECT DISTINCT * FROM CREATE_INFO';
        $stmt = $db->query($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
<body>
    
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Menu</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
            <a class="nav-item nav-link active" href="/AdjusTime/Add.php">Add <span class="sr-only">(current)</span></a>
            </div>
        </div>
        </nav>

        <div class="ScheduleTitle">
            <br><h1>Today's Time Table</h1>
        </div>

    
    <div align="center">
        <br>
        <table border="1" style="border-collapse: collapse; border-color: #99CC00">
            <tr>
                <th>No.</th>
                <th>Band</th>
                <th>Start</th>
                <th>End</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php foreach($result as $value): ?>
                <tr>
                    <td><?php echo $value->id; ?></td>
                    <td><?php echo $value->Band; ?></td>
                    <td><?php echo $value->StarTime; ?></td>
                    <td><?php echo $value->EndTime; ?></td>
                    <td>
                            <a href="Edit.php?id=<?= $value->id ?>" class="btn btn-primary">Edit</a>
                        </td>
                        <td>
                            <a onclick="return confirm('本当に削除してよろしいですか？')" href="Delete.php?id=<?= $value->id ?>" class="btn btn-danger">Delete</a>
                        </td>
                </tr>   
            <?php endforeach; ?>
        </table>
    </div>

    <div class="col-12">
        <div class="mx-auto test-box" style="width: 250px;">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="Schedule.php?id=<?= $value->id ?>">Previous</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>

                

</body>

<div class="LoginFooter">    
    <footer>
        <p>©Copyright Hirofumi Ishii 2020.</p>
    </footer>
</div>

</html>