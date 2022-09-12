<?php
session_start();

include("funcs.php");

//1.  DB接続します
$pdo = db_conn();

$id = $_SESSION['id'];

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT DISTINCT plan_id, plan, duration, image FROM gs_favorites_table WHERE user_id=:id");
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$status = $stmt->execute();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>お気に入りプラン</title>
  <link rel="stylesheet" href="css/styling2.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <style>div{font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header class="favorites_header">
<div class="filter_icon"><span class="material-symbols-outlined active" style="color: white">tune</span></div>
    <div class="navbar-header"><a class="navbar-brand" href="index.php">登録済お気に入りプラン</a></div>
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
    <?php
        //３．データ表示
        $view="";
        if($status==false) {
            //execute（SQL実行時にエラーがある場合）
        $error = $stmt->errorInfo();
        exit("SQL_ERROR:".$error[2]);
        }else{
            while($r = $stmt->fetch(PDO::FETCH_ASSOC)){
                $view .= '<div class="plan_box"><img class="plan_image" src="images/'.$r["image"].'">';
                $view .= '<div class="plan_heading"><p><a href="detail.php?id='.h($r["plan_id"]).'">';
                $view .= $r["plan"].'</a></p>';
                $view .= '<p>約'.h($r["duration"]).'時間</p></div></div>';
              }
            echo $view;
        }
    ?>
</fieldset>
<!-- Main[End] -->
