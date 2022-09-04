<?php
//１．PHP
//select.phpの[PHPコードだけ！]をマルっとコピーしてきます。
//※SQLとデータ取得の箇所を修正します。
$id = $_GET["id"];

include("funcs.php");

//1.  DB接続します
$pdo = db_conn();

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_plan_table WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
$view="";
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
  <link rel="stylesheet" href="css/style.css">
  <style>div{font-size:16px;}</style>
</head>
<body>

<!-- Main[Start] -->
<form method="post" action="plan_update_act.php">
  <div class="jumbotron">
   <fieldset>
    <legend style="font-size: 25px">お出かけプラン内容 修正</legend>
     <label>お出かけプラン<div style="color: red; font-size: 12px; display: inline-block">(*)</div>：<br><input type="text" name="plan" style="margin: 10px 0; width: 299px" value="<?=$row["plan"]?>" required></label><br>
     <label>所要時間<div style="color: red; font-size: 12px; display: inline-block">(*)</div>：<br><textArea name="duration" rows="1" cols="80" required><?=$row["duration"]?></textArea></label><br>
     <label>場所<div style="color: red; font-size: 12px; display: inline-block">(*)</div>：<br><textArea name="place" rows="2" cols="80" required><?=$row["place"]?></textArea></label><br>
     <label>概要<div style="color: red; font-size: 12px; display: inline-block">(*)</div>：<br><textArea name="summary" rows="10" cols="80" required><?=$row["summary"]?></textArea></label><br>
     <label>タグ<div style="color: red; font-size: 12px; display: inline-block">(*)</div>：<br>
        <input type="checkbox" name="tags[]" value="photoshooting" <?php if(strpos($row["tags"],'photoshooting') !== false){ ?> checked="checked" <?php } ?>><label for="photoshooting">写真撮影</label>
        <input type="checkbox" name="tags[]" value="shopping" <?php if(strpos($row["tags"],'shopping') !== false){ ?> checked="checked" <?php } ?>><label for="shopping">買い物</label>
        <input type="checkbox" name="tags[]" value="karaoke" <?php if(strpos($row["tags"],'karaoke') !== false){ ?> checked="checked" <?php } ?>><label for="karaoke">カラオケ</label>
        <input type="checkbox" name="tags[]" value="yoga" <?php if(strpos($row["tags"],'yoga') !== false){ ?> checked="checked" <?php } ?>><label for="yoga">ヨガ</label>
        <input type="checkbox" name="tags[]" value="cuisine" <?php if(strpos($row["tags"],'cuisine') !== false){ ?> checked="checked" <?php } ?>><label for="cuisine">料理</label>
        <input type="checkbox" name="tags[]" value="tennis" <?php if(strpos($row["tags"],'tennis') !== false){ ?> checked="checked" <?php } ?>><label for="tennis">テニス</label>
        <input type="checkbox" name="tags[]" value="running" <?php if(strpos($row["tags"],'running') !== false){ ?> checked="checked" <?php } ?>><label for="running">ランニング</label>
        <input type="checkbox" name="tags[]" value="swimming" <?php if(strpos($row["tags"],'swimming') !== false){ ?> checked="checked" <?php } ?>><label for="swimming">水泳</label>
        <input type="checkbox" name="tags[]" value="art" <?php if(strpos($row["tags"],'art') !== false){ ?> checked="checked" <?php } ?>><label for="art">アート</label>
        <input type="checkbox" name="tags[]" value="traveling" <?php if(strpos($row["tags"],'traveling') !== false){ ?> checked="checked" <?php } ?>><label for="traveling">旅行</label>
        <input type="checkbox" name="tags[]" value="thrill" <?php if(strpos($row["tags"],'thrill') !== false){ ?> checked="checked" <?php } ?>><label for="thrill">スリル</label>
        <input type="checkbox" name="tags[]" value="music" <?php if(strpos($row["tags"],'music') !== false){ ?> checked="checked" <?php } ?>><label for="music">音楽</label>
        <input type="checkbox" name="tags[]" value="alcohol" <?php if(strpos($row["tags"],'school') !== false){ ?> checked="checked" <?php } ?>><label for="alcohol">お酒</label>
        <input type="checkbox" name="tags[]" value="game" <?php if(strpos($row["tags"],'game') !== false){ ?> checked="checked" <?php } ?>><label for="game">ゲーム</label>
     <br>
     <label>URL<div style="color: red; font-size: 12px; display: inline-block">(*)</div>：<br><textArea name="URL" rows="1" cols="80" required><?=$row["URL"]?></textArea></label><br>
     <div style="color: red; font-size: 12px; display: inline-block">(*)：required</div><br>
    <!-- idを隠して送信 -->
    <input type="hidden" name="id" value="<?=$row["id"]?>">
    <!-- idを隠して送信 -->
    <input type="submit" value="Send" style="margin: 20px 0">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>




