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
  <title>データ更新</title>
  <link rel="stylesheet" href="css/styling2.css">
  <style>div{font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="index.php"></a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
   <fieldset>
    <legend style="font-size: 25px"><?=$row["plan"]?></legend>
     <p class="detail_img"><img src="images/<?=$row["image"]?>"><br><a href="navigation.php?id=<?=$row['id']?>">今すぐ行ってみる！</a></p><br>
     <p>所要時間：約<?=$row["duration"]?>時間</p><br>
     <p>場所：<?=$row["place"]?></p><br>
     <p>概要：<?=$row["summary"]?></p><br>
     <p>タグ：<?=$row["tags"]?></p><br>
     <p>URL：<a href="<?=$row["URL"]?>"><?=$row["URL"]?></a></p>
    </fieldset>
<!-- Main[End] -->


</body>
</html>




