<?php
    //表示とページネーション
    define('max_view',4);
    try{
        $db = new PDO('mysql:host=localhost;dbname=SCHEDULE','root','root');
        //必要ページ数を数える
        $sql = 'SELECT COUNT(*) AS count FROM CREATE_INFO';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $total_count = $stmt->fetch(PDO::FETCH_ASSOC);
        $pages = ceil($total_count['count'] / max_view);
        // 現在のページ数を取得
        if(isset($_GET['page_id'])) {
            $page = $_GET['page_id'];
        } else {
            $page = 1;
        }
        $sql = 'SELECT DISTINCT * FROM CREATE_INFO ORDER BY id LIMIT :start,:max';
        $stmt = $db->prepare($sql);
        if($page == 1){
            $stmt->bindValue(":start",$page-1,PDO::PARAM_INT);
            $stmt->bindValue(":max",max_view,PDO::PARAM_INT);
        }else{
            $stmt->bindValue(":start",($page-1)*4,PDO::PARAM_INT);
            $stmt->bindValue(":max",max_view,PDO::PARAM_INT);
        }
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
        <a class="navbar-brand">Menu</a>
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
                <!-- ページネーションを表示 -->
                    <?php
                    // for($n=1; $n <= $pages; $n++){
                    //     if($n == $page){
                    //         echo "$page";
                    //     }else{
                    //         echo "<a href='./Schedule.php?page_id=$n'>$n</a>";
                    //     }
                    // }
                    ?>
                <!-- Bootstrap4でページネーション表示 -->
                    <li class="page-item">
                    <a class="page-link" href="?page_id=<?php echo ($page - 1); ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="?page_id=1">1</a></li>
                    <li class="page-item"><a class="page-link" href="?page_id=2">2</a></li>
                    <li class="page-item"><a class="page-link" href="?page_id=3">3</a></li>
                    <li class="page-item">
                    <a class="page-link" href="?page_id=<?php echo ($page + 1); ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                    </li>
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