<?php
$id = $_GET["id"];

include("funcs.php");

//1.  DB接続します
$pdo = db_conn();

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_plan_table WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("SQL_ERROR:".$error[2]);
}else{
    $row = $stmt->fetch(); // 1つのデータを取り出して $rowに格納
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ナビゲーション</title>
  <link rel="stylesheet" href="css/styling2.css">
  <style>div{font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="detail.php?id=<?=$row['id']?>">ナビゲーション</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
  <div class="jumbotron">
   <fieldset>
    <legend style="font-size: 25px"><?=$row["plan"]?></legend>
    <div class="google_map">
        <?=$row["map"]?>
    </div>
    </fieldset>
  </div>
<!-- Main[End] -->


</body>
</html>
