<?php
session_start();

//※htdocsと同じ階層に「includes」を作成してfuncs.phpを入れましょう！
//include "../../includes/funcs.php";
include "funcs.php";
sschk();
$id = $_SESSION['id'];

//1. DB接続
$pdo = db_conn();

//2.データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE id=:id");
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$status = $stmt->execute();

//3.データ表示
$view = "";
if ($status == false) {
    sql_error($stmt);
} else {
    $row = $stmt->fetch();
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ更新</title>
  <link rel="stylesheet" href="css/styling2.css">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header class="profile_detail_header">
    <div class="navbar-header"><a class="navbar-brand" href="index.php"><?php echo $_SESSION["name"]; ?>さん</a></div>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form class="profile_detail_form" method="post" action="profile_update.php">
<?php
if($row["kanri_flg"]=="1"){
?>
    <fieldset>
        <legend style="font-size: 25px">プロフィール情報</legend>
        <p><label>名前：<input type="text" name="name" value="<?php echo $row["name"]; ?>"></label></p><br>
        <p><label>Login ID：<input type="text" name="lid" value="<?php echo $row["lid"]; ?>"></label></p><br>
        <p><label>Login PW：<input type="text" name="lpw" placeholder="変更する場合のみ入力ください"></label></p><br>
        <p><label>興味のあるテーマ：
            <input type="checkbox" name="preferences[]" value="photoshooting" <?php if(strpos($row["preferences"],'photoshooting') !== false){ ?> checked="checked" <?php } ?>><label for="photoshooting">写真撮影</label>
            <input type="checkbox" name="preferences[]" value="shopping" <?php if(strpos($row["preferences"],'shopping') !== false){ ?> checked="checked" <?php } ?>><label for="shopping">買い物</label>
            <input type="checkbox" name="preferences[]" value="karaoke" <?php if(strpos($row["preferences"],'karaoke') !== false){ ?> checked="checked" <?php } ?>><label for="karaoke">カラオケ</label>
            <input type="checkbox" name="preferences[]" value="yoga" <?php if(strpos($row["preferences"],'yoga') !== false){ ?> checked="checked" <?php } ?>><label for="yoga">ヨガ</label>
            <input type="checkbox" name="preferences[]" value="cuisine" <?php if(strpos($row["preferences"],'cuisine') !== false){ ?> checked="checked" <?php } ?>><label for="cuisine">料理</label>
            <input type="checkbox" name="preferences[]" value="tennis" <?php if(strpos($row["preferences"],'tennis') !== false){ ?> checked="checked" <?php } ?>><label for="tennis">テニス</label>
            <input type="checkbox" name="preferences[]" value="running" <?php if(strpos($row["preferences"],'running') !== false){ ?> checked="checked" <?php } ?>><label for="running">ランニング</label>
            <input type="checkbox" name="preferences[]" value="swimming" <?php if(strpos($row["preferences"],'swimming') !== false){ ?> checked="checked" <?php } ?>><label for="swimming">水泳</label>
            <input type="checkbox" name="preferences[]" value="art" <?php if(strpos($row["preferences"],'art') !== false){ ?> checked="checked" <?php } ?>><label for="art">アート</label>
            <input type="checkbox" name="preferences[]" value="traveling" <?php if(strpos($row["preferences"],'traveling') !== false){ ?> checked="checked" <?php } ?>><label for="traveling">旅行</label>
            <input type="checkbox" name="preferences[]" value="thrill" <?php if(strpos($row["preferences"],'thrill') !== false){ ?> checked="checked" <?php } ?>><label for="thrill">スリル</label>
            <input type="checkbox" name="preferences[]" value="music" <?php if(strpos($row["preferences"],'music') !== false){ ?> checked="checked" <?php } ?>><label for="music">音楽</label>
            <input type="checkbox" name="preferences[]" value="alcohol" <?php if(strpos($row["preferences"],'school') !== false){ ?> checked="checked" <?php } ?>><label for="alcohol">お酒</label>
            <input type="checkbox" name="preferences[]" value="game" <?php if(strpos($row["preferences"],'game') !== false){ ?> checked="checked" <?php } ?>><label for="game">ゲーム</label>
        </label></p><br>
        <p><label>管理FLG：
                一般<input type="radio" name="kanri_flg" value="0">　
                管理者<input type="radio" name="kanri_flg" value="1" checked="checked">
        </label></p><br>
        <p><label>退会FLG：
        <?php if($row["life_flg"]=="0"){ ?>
                利用中<input type="radio" name="life_flg" value="0" checked="checked">　
                退会<input type="radio" name="life_flg" value="1">
            <?php }else{ ?>
                利用中<input type="radio" name="life_flg" value="0">　
                退会<input type="radio" name="life_flg" value="1" checked="checked">
            <?php } ?>
        </label></p><br>
        <a class="back_button" href="index.php"><input type="button" value="戻る"></a>
        <input type="submit" value="更新">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
    </fieldset>

<?php } else{ ?>
    <fieldset>
        <legend style="font-size: 25px">プロフィール情報</legend>
        <p><label>名前：<input type="text" name="name" value="<?php echo $row["name"]; ?>"></label></p><br>
        <p><label>Login ID：<input type="text" name="lid" value="<?php echo $row["lid"]; ?>"></label></p><br>
        <p><label>Login PW：<input type="text" name="lpw" style="width: 200px" placeholder="変更する場合のみ入力ください"></label></p><br>
        <p><label>興味のあるテーマ：
            <input type="checkbox" name="preferences[]" value="photoshooting" <?php if(strpos($row["preferences"],'photoshooting') !== false){ ?> checked="checked" <?php } ?>><label for="photoshooting">写真撮影</label>
            <input type="checkbox" name="preferences[]" value="shopping" <?php if(strpos($row["preferences"],'shopping') !== false){ ?> checked="checked" <?php } ?>><label for="shopping">買い物</label>
            <input type="checkbox" name="preferences[]" value="karaoke" <?php if(strpos($row["preferences"],'karaoke') !== false){ ?> checked="checked" <?php } ?>><label for="karaoke">カラオケ</label>
            <input type="checkbox" name="preferences[]" value="yoga" <?php if(strpos($row["preferences"],'yoga') !== false){ ?> checked="checked" <?php } ?>><label for="yoga">ヨガ</label>
            <input type="checkbox" name="preferences[]" value="cuisine" <?php if(strpos($row["preferences"],'cuisine') !== false){ ?> checked="checked" <?php } ?>><label for="cuisine">料理</label>
            <input type="checkbox" name="preferences[]" value="tennis" <?php if(strpos($row["preferences"],'tennis') !== false){ ?> checked="checked" <?php } ?>><label for="tennis">テニス</label>
            <input type="checkbox" name="preferences[]" value="running" <?php if(strpos($row["preferences"],'running') !== false){ ?> checked="checked" <?php } ?>><label for="running">ランニング</label>
            <input type="checkbox" name="preferences[]" value="swimming" <?php if(strpos($row["preferences"],'swimming') !== false){ ?> checked="checked" <?php } ?>><label for="swimming">水泳</label>
            <input type="checkbox" name="preferences[]" value="art" <?php if(strpos($row["preferences"],'art') !== false){ ?> checked="checked" <?php } ?>><label for="art">アート</label>
            <input type="checkbox" name="preferences[]" value="traveling" <?php if(strpos($row["preferences"],'traveling') !== false){ ?> checked="checked" <?php } ?>><label for="traveling">旅行</label>
            <input type="checkbox" name="preferences[]" value="thrill" <?php if(strpos($row["preferences"],'thrill') !== false){ ?> checked="checked" <?php } ?>><label for="thrill">スリル</label>
            <input type="checkbox" name="preferences[]" value="music" <?php if(strpos($row["preferences"],'music') !== false){ ?> checked="checked" <?php } ?>><label for="music">音楽</label>
            <input type="checkbox" name="preferences[]" value="alcohol" <?php if(strpos($row["preferences"],'alcohol') !== false){ ?> checked="checked" <?php } ?>><label for="alcohol">お酒</label>
            <input type="checkbox" name="preferences[]" value="game" <?php if(strpos($row["preferences"],'game') !== false){ ?> checked="checked" <?php } ?>><label for="game">ゲーム</label>
        </label></p><br>
        <p><label>退会FLG：
        <?php if($row["life_flg"]=="0"){ ?>
                利用中<input type="radio" name="life_flg" value="0" checked="checked">　
                退会<input type="radio" name="life_flg" value="1">
            <?php }else{ ?>
                利用中<input type="radio" name="life_flg" value="0">　
                退会<input type="radio" name="life_flg" value="1" checked="checked">
            <?php } ?>
        </label></p><br>
        <a class="back_button" href="index.php"><input type="button" value="戻る"></a>
        <input type="submit" value="更新">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        </fieldset>
<?php } ?>
</form>
<!-- Main[End] -->


</body>
</html>
