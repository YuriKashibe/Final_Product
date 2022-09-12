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
    <div class=lottery_area>
      <?php
      $num = rand(1,3); // ランダムな数字を生成する
      if( $num == 1 || $num == 2 ) { ?>
        <h2>お得なクーポンをゲット！</h2>
        <p class="lottery_subheading">表示されているプロモーションコードを現地で見せれば、全ての購入金額から10% OFF!</p>
        <br>
        <div class="lottery">クーポンコード：<?php echo $row["promo"] ?></div>
      <?php } else { ?>
        <h2>クーポンガチャのチャンス！</h2>
        <p class="lottery_subheading">今日はあなたのラッキーday! ガチャを引けばお得なクーポンがゲットできるかも...？</p>
        <br>
        <?php $num2 = rand(1,3);
        if($num2 == 1){ ?>
          <input id="lottery_button" type="checkbox">
          <label class="lottery_button_label" for="lottery_button">ガチャを引く</label>
          <div class="lottery_result">
            <p>1等...! おめでとうございます！表示されているプロモーションコードを現地で見せれば、全ての購入金額から30% OFF!</p>
            <div class="lottery">クーポンコード：<?php echo $row["promo"] ?></div>
          </div>
        <?php }elseif($num2 == 2){?>
          <input id="lottery_button" type="checkbox">
          <label class="lottery_button_label" for="lottery_button">ガチャを引く</label>
          <div class="lottery_result">
            <p>2等...! おめでとうございます！表示されているプロモーションコードを現地で見せれば、全ての購入金額から10% OFF!</p>
            <div class="lottery">クーポンコード：<?php echo $row["promo"] ?></div>
          </div>
        <?php }else{ ?>
          <input id="lottery_button" type="checkbox">
          <label class="lottery_button_label" for="lottery_button">ガチャを引く</label>
          <div class="lottery_result">
            <p>残念...！今回はハズレのようです。また次回チャレンジしてみてください！</p>
          </div>
        <?php } ?>
      <?php } ?>
    </div>
    </fieldset>
  </div>
<!-- Main[End] -->


</body>
</html>
