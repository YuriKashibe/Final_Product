<?php
session_start();

include "funcs.php";
sschk();

// 入力チェック(受信確認処理追加)
if(
    !isset($_POST["preferences"]) || $_POST["preferences"]==""
  ){
    exit('ParamError');
  }

  //1. POSTデータ取得
  //$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
  //$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ

$arr_preferences = $_POST['preferences'];
$id          =$_SESSION['id'];
$str_preferences = "";

for($i=0;$i<count($arr_preferences);$i++){
if($i == 0){
$str_preferences .= $arr_preferences[$i];
}
else{
$str_preferences .= " " . $arr_preferences[$i];
}
}

  //2. DB接続します
  $pdo = db_conn();

  // tryの中身を実行して、何かしらエラーが起きたら、catchの内容実行してね、という意味

  //３．データ登録SQL作成
$sql = "UPDATE gs_user_table SET preferences=:str_preferences WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':str_preferences', $str_preferences, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

  //４．データ登録処理後
  if($status==false){
    sql_error($stmt);
  }else{
    redirect("index.php");
  }

?>
