<?php
session_start();
//1. GETデータ取得
$id      = $_GET["id"];
$user_id = $_SESSION["id"];

//2. DB接続します
include("funcs.php");  //funcs.phpを読み込む（関数群）
sschk();               //ログイン済かチェック
$pdo = db_conn();      //DB接続関数

$stmt = $pdo->prepare("SELECT * FROM gs_plan_table WHERE id=:id");
$stmt->bindValue(":id",$id,PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
    sql_error($stmt);
} else {
    $row = $stmt->fetch();
}

$plan_id = $row["id"];
$plan = $row["plan"];

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_favorites_table(user_id,plan_id,plan)VALUES(:user_id,:plan_id,:plan)");
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':plan_id', $plan_id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':plan', $plan, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();


//４．データ登録処理後
if($status==false){
    sql_error($stmt);
}else{
    echo "<script>alert('お気に入り登録しました');document.location='index.php'</script>";
}
?>
