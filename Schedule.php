<?php

session_start();

if(!isset($_SESSION["username"])) {
    $no_login_url = "validate.php";
    header("Location: {$no_login_url}");
    exit;
}
    //表示最大数とページネーション
    define('max_view',4);
    try{
        $db = new PDO('mysql:host=localhost;dbname=SCHEDULE','root','root');
        //ページネーション準備
        if(isset($_GET['page_id']) && is_numeric($_GET['page_id'])) {
            $page = $_GET['page_id'];
        } else {
            $page = 1;
        }
        $start = 4 * ($page -1);

        //呼び出せる件数
        $sql = 'SELECT DISTINCT * FROM CREATE_INFO ORDER BY id LIMIT ?,4';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(1, $start, PDO::PARAM_INT);
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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand">Menu</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" 
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <!-- navbar内で左右に機能を振る -->
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <a class="nav-link" href="/AdjusTime/Add.php">Add <span class="sr-only">(current)</span></a>
              </li>
            </ul>
            
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="/AdjusTime/Logout.php">Logout <span class="sr-only">(current)</span></a>
              </li>
            </ul>
            
        </div>
    </nav>

    <!-- ハンバーガーアクティブ用js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
    crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" 
    crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" 
    crossorigin="anonymous"></script>

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
                        <a onclick="return confirm('本当に削除してよろしいですか？')" href="Delete.php?id=<?= $value->id ?>" 
                        class="btn btn-danger">Delete</a>
                    </td>
                </tr>   
            <?php endforeach; ?>
        </table>
    </div>

    <div class="col-12">
        <div class="mx-auto test-box" style="width: 150px;">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                <!-- Bootstrap4でページネーション表示 -->
                    <li class="page-item">
                    <?php if($page >= 2): ?>
                        <a class="page-link" href="?page_id=<?php echo ($page - 1); ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    <?php endif; ?>
                        <span class="sr-only">Previous</span>
                    </a>
                    </li>
                    
                    <?php
                    // 必要なページ数を求める
                    $db = new PDO('mysql:host=localhost;dbname=SCHEDULE','root','root');
                    $counts = $db->query('SELECT COUNT(*) AS cnt FROM CREATE_INFO');
                    $count = $counts->fetch();
                    $max_view = ceil($count['cnt']/max_view);
                    if($page < $max_view):
                    ?>
                    
                    <?php for($i=1; $i<=$max_view; $i++) : ?>
                        <li class="page-item"><a class="page-link" href="?page_id=<?= $i; ?>"><?= $i; ?></a></li>
                    <?php endfor; ?>
                    <a class="page-link" href="?page_id=<?php echo ($page + 1); ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    <?php endif;?>
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