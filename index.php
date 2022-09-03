<?php

session_start();

include("funcs.php");

sschk();

//1.  DB接続します
$pdo = db_conn();

//２．データ取得SQL作成
$str_preferences = $_SESSION["preferences"];
$arr_preferences = explode(" ", $str_preferences);
$arr_count = count($arr_preferences);

$sql_like = "";
for ($i = 0; $i < $arr_count; $i++){
  if($i == 0){
    $sql_like .= ' tags LIKE ' . "'%" . $arr_preferences[$i] . "%'";
  }
    else if ($i >= 1) {
      $sql_like .= ' OR tags LIKE ' . "'%" . $arr_preferences[$i] . "%'";
    }
  }

$stmt = $pdo->prepare("SELECT *  FROM gs_plan_table WHERE".$sql_like);
$status = $stmt->execute();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>ホーム</title>
  <link rel="stylesheet" href="css/styling2.css">
  <style>div{font-size:16px;}</style>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body>

<!-- Head[Start] -->
<header class="index_header">
      <div class="filter_icon"><span class="material-symbols-outlined">tune</span></div>
      <div class="navbar-header"><a class="navbar-brand" href="select.php">見つける<br><div style="font-size: 16px;"><?php echo h($_SESSION['city']); ?></div></a></div>
      <div class="profile_icon"><span class="material-symbols-outlined active">person</span>
        <div class="subMenu-1">
          <ul>
            <li><a href="#">プロフィール</a></li>
            <li><a href="#">お気に入りコンテンツ</a></li>
            <li><a href="logout.php">ログアウト</a></li>
          </ul>
        </div>
      </div>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div class="result_container" id="view">
  <?php
    //３．データ表示
    $view="";
    if($status==false) {
      sql_error($stmt);
    }else if($_SESSION["kanri_flg"] == 1){
      //Selectデータの数だけ自動でループしてくれる
      //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
      while($r = $stmt->fetch(PDO::FETCH_ASSOC)){
        $view .= '<div class="plan_box"><img class="plan_image" src="images/'.$r["image"].'">';
        $view .= '<div class="plan_heading"><p><a href="plan_update.php?id='.h($r["id"]).'">';
        $view .= $r["plan"].'</a></p>';
        $view .= '<p>'.h($r["duration"]).'</p></div>';
        $view .= '<a class="btn btn-danger" href="delete.php?id='.$r["id"].'">';
        $view .= '[<i class="glyphicon glyphicon-remove"></i>削除]';
        $view .= '</a></div>';
      }
      echo $view;
    }else{
      while($r = $stmt->fetch(PDO::FETCH_ASSOC)){
      //Selectデータの数だけ自動でループしてくれる
      //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
      $view .= '<div class="plan_box"><img class="plan_image" src="images/'.$r["image"].'">';
      $view .= '<div class="plan_heading"><p><a href="detail.php?id='.h($r["id"]).'">';
      $view .= $r["plan"].'</a></p>';
      $view .= '<p>'.h($r["duration"]).'</p></div></div>';
      // array_merge($r);
      // array_unique($r);
      // var_dump($r);
    }
    echo $view;
  }
  ?>
</div>
<!-- Main[End] -->


</body>
</html>
