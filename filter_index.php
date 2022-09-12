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

// $stmt = $pdo->prepare("SELECT *  FROM gs_plan_table WHERE".$sql_like);
// $status = $stmt->execute();

if(isset($_POST["max_filter"])){
    $max_filter=$_POST["max_filter"];
    if(isset($_POST["min_filter"])){
        $min_filter=$_POST["min_filter"];
        $stmt = $pdo->prepare("SELECT * FROM gs_plan_table WHERE(" . $sql_like . ") AND (duration <= " . $max_filter . " OR duration >=" . $min_filter . ")");
        $status = $stmt->execute();
    }else{
        $stmt = $pdo->prepare("SELECT * FROM gs_plan_table WHERE(" . $sql_like . ") AND duration <= " . $max_filter);
        $status = $stmt->execute();
        }
}elseif(isset($_POST["min_filter"])){
        $min_filter=$_POST["min_filter"];
        $stmt = $pdo->prepare("SELECT * FROM gs_plan_table WHERE(" . $sql_like . ") AND duration >= " . $min_filter);
        $status = $stmt->execute();
}else{
    redirect("index.php");
}

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
      <div class="filter_icon"><span class="material-symbols-outlined active">tune</span>
        <form class="subMenu-2" action="filter_index.php" method="post">
          <input type="radio" name="max_filter" value="0.5" <?php if(isset($_POST["max_filter"]) && $max_filter == 0.5){ ?> checked <?php } ?>>
            <label for="0.5">30分以下</label>
          <input type="radio" name="max_filter" value="1" <?php if(isset($_POST["max_filter"]) && $max_filter == 1){ ?> checked <?php } ?>>
            <label for="1">1時間以下</label>
          <input type="radio" name="max_filter" value="2" <?php if(isset($_POST["max_filter"]) && $max_filter == 2){ ?> checked <?php } ?>>
            <label for="2">2時間以下</label>
          <input type="radio" name="min_filter" value="2" <?php if(isset($_POST["min_filter"]) && $min_filter == 2){ ?> checked <?php } ?>>
            <label for="2">2時間以上</label>
          <div class="filter_button"><input class="filter_submit" type="submit" value="適用" /></div>
          <div class="filter_button"><a href="index.php"><input type="button" value="クリア"></div></a>
        </div>
          </form>
      <div class="navbar-header"><a class="navbar-brand" href="index.php">見つける<br><div style="font-size: 16px;"><?php echo h($_SESSION['city']); ?></div></a></div>
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
<div class="result_container" id="view">
  <?php
    //３．データ表示
    $view="";
    if($status==false) {
      sql_error($stmt);
    }else if($_SESSION["kanri_flg"] == 1){
      while($r = $stmt->fetch(PDO::FETCH_ASSOC)){
        $view .= '<div class="plan_box"><img class="plan_image" src="images/'.$r["image"].'">';
        $view .= '<div class="favorites_icon"><a href="favorites_act.php?id='.$r["id"].'"><span class="material-symbols-outlined">favorite</span></a></div>';
        $view .= '<div class="plan_heading"><p><a href="plan_update.php?id='.h($r["id"]).'">';
        $view .= $r["plan"].'</a></p>';
        $view .= '<p>約'.h($r["duration"]).'時間';
        $view .= '<a class="delete_button" href="delete.php?id='.$r["id"].'">';
        $view .= '<span class="material-symbols-outlined">delete</span>';
        $view .= '</a></p></div></div>';
      }
      echo $view;
    }else{
      while($r = $stmt->fetch(PDO::FETCH_ASSOC)){
      $view .= '<div class="plan_box"><img class="plan_image" src="images/'.$r["image"].'">';
      $view .= '<div class="favorites_icon"><a href="favorites_act.php?id='.$r["id"].'"><span class="material-symbols-outlined">favorite</span></a></div>';
      $view .= '<div class="plan_heading"><p><a href="detail.php?id='.h($r["id"]).'">';
      $view .= $r["plan"].'</a></p>';
      $view .= '<p>約'.h($r["duration"]).'時間</p></div></div>';
    }
    echo $view;
  }
  ?>
</div>
<!-- Main[End] -->
</body>
</html>

