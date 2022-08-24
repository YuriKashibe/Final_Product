<?php
session_start();

include "funcs.php";
sschk();

// 入力チェック(受信確認処理追加)
if(
    !isset($_POST["prefecture"]) || $_POST["prefecture"]=="" ||
    !isset($_POST["city"]) || $_POST["city"]=="" ||
    !isset($_POST["birthday"]) || $_POST["birthday"]=="" ||
    !isset($_POST["gender"]) || $_POST["gender"]==""
  ){
    exit('ParamError');
  }

  //1. POSTデータ取得
  //$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
  //$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ

$prefecture = $_POST['prefecture'];
$city       = $_POST['city'];
$birthday   = $_POST['birthday'];
$gender     =$_POST['gender'];
$id         =$_SESSION['id'];

  //2. DB接続します
  $pdo = db_conn();

  // tryの中身を実行して、何かしらエラーが起きたら、catchの内容実行してね、という意味

  //３．データ登録SQL作成
$sql = "UPDATE gs_user_table SET prefecture=:prefecture,city=:city,birthday=:birthday,gender=:gender WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':prefecture', $prefecture, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':city', $city, PDO::PARAM_STR);
$stmt->bindValue(':birthday', $birthday, PDO::PARAM_STR);
$stmt->bindValue(':gender', $gender, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

  //４．データ登録処理後
  if($status==false){
    sql_error($stmt);
  }else{
    redirect("preferences.php");
  }

?>
