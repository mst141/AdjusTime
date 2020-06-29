<?php
echo "3秒後にログイン画面へ遷移します。遷移しない場合は<a href='/AdjusTime/Login.php'>こちら</a>をクリックしてください。";

//3秒後に遷移する
echo <<<EOM
<script type="text/javascript">
    setTimeout(function(){
  window.location.href = '/AdjusTime/Login.php';
}, 3*1000);
</script>
EOM;
?>