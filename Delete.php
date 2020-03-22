<?php  
    $id = $_GET['id'];
    try{
        $db = new PDO('mysql:host=localhost;dbname=SCHEDULE','root','root');
        $sql = 'DELETE FROM CREATE_INFO WHERE id=:id';
        $stmt = $db->prepare($sql);
        if($stmt->execute([':id' => $id])){
            header('Location: http://192.168.33.10/AdjusTime/Schedule.php');
            exit;
        }
    }catch(PDOException $e){
        echo $e->getMessage();
        exit;
    }
?>