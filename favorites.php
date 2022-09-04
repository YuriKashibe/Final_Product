<?php
session_start();

include("funcs.php");

//1.  DB接続します
$pdo = db_conn();

$id = $_SESSION['id'];

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT DISTINCT plan_id, plan FROM gs_favorites_table WHERE user_id=:id");
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$status = $stmt->execute();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>お気に入りプラン</title>
  <link rel="stylesheet" href="css/styling2.css">
  <style>div{font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header class="favorites_header">
    <div class="navbar-header"><a class="navbar-brand" href="index.php">登録済お気に入りプラン</a></div>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div class="jumbotron">
    <?php
        //３．データ表示
        $view="";
        if($status==false) {
            //execute（SQL実行時にエラーがある場合）
        $error = $stmt->errorInfo();
        exit("SQL_ERROR:".$error[2]);
        }else{
            while($r = $stmt->fetch(PDO::FETCH_ASSOC)){
                $view .= '<div class="favorite_box"><a href="detail.php?id='.h($r["plan_id"]).'">'.h($r["plan"]).'</div><br>';
              }
            echo $view;
        }
    ?>
</div>
<!-- Main[End] -->
