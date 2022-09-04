<?php
session_start();
//1. POSTデータ取得
$plan       = $_POST["plan"];
$duration   = $_POST["duration"];
$place      = $_POST["place"];
$summary    = $_POST["summary"];
$arr_tags   = $_POST["tags"];

$arr_tags   = $_POST['tags'];
$str_tags   = "";

for($i=0;$i<count($arr_tags);$i++){
    if($i == 0){
    $str_tags .= $arr_tags[$i];
    }
    else{
    $str_tags .= " " . $arr_tags[$i];
    }
}

$URL        = $_POST["URL"];
$id         = $_POST["id"];

//2. DB接続します
include("funcs.php");  //funcs.phpを読み込む（関数群）
sschk();               //ログイン済かチェック
$pdo = db_conn();      //DB接続関数

//３．データ登録SQL作成
$sql = "UPDATE gs_plan_table SET plan=:plan, duration=:duration, place=:place, summary=:summary, tags=:str_tags, URL=:URL WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':plan', $plan, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':duration', $duration, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':place', $place, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':summary', $summary, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':str_tags', $str_tags, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':URL', $URL, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

//４．データ登録処理後
if($status==false){
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit("SQL_ERROR:".$error[2]);
}else{
    redirect("index.php");
}

?>
