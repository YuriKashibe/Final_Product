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
  <title>プラン詳細</title>
  <link rel="stylesheet" href="css/styling2.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <style>div{font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header class="favorites_header">
<div class="filter_icon"><span class="material-symbols-outlined active" style="color: white">tune</span></div>
    <div class="navbar-header"><a class="navbar-brand" href="index.php">プラン詳細</a></div>
    <div class="profile_icon"><span class="material-symbols-outlined active">person</span>
        <div class="subMenu-1">
          <ul>
            <li><a href="profile_detail.php">プロフィール</a></li>
            <li><a href="favorites.php">お気に入りコンテンツ</a></li>
            <li><a href="logout.php">ログアウト</a></li>
          </ul>
        </div>
      </div>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
   <fieldset>
    <legend style="font-size: 25px"><?=$row["plan"]?></legend>
     <p class="detail_img"><img src="images/<?=$row["image"]?>"><br><a href="navigation.php?id=<?=$row['id']?>">今すぐ行ってみる！<br>(今ならお得なキャンペーン実施中！)</a></p><br>
     <p>所要時間：約<?=$row["duration"]?>時間</p><br>
     <p>場所：<?=$row["place"]?></p><br>
     <p>概要：<?=$row["summary"]?></p><br>
     <p>タグ：<?=$row["tags"]?></p><br>
     <p>URL：<a href="<?=$row["URL"]?>"><?=$row["URL"]?></a></p>
    </fieldset>
<!-- Main[End] -->


</body>
</html>




