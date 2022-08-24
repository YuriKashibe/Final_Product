<?php
session_start();

// 入力チェック(受信確認処理追加)
if(
    !isset($_POST["name"]) || $_POST["name"]=="" ||
    !isset($_POST["lid"]) || $_POST["lid"]=="" ||
    !isset($_POST["lpw"]) || $_POST["lpw"]==""
  ){
    exit('ParamError');
  }

  //1. POSTデータ取得
  //$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
  //$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ

  $name = $_POST['name'];
  $lid = $_POST['lid'];
  $lpw = $_POST['lpw'];
  $lpw = password_hash($lpw, PASSWORD_DEFAULT);

  //2. DB接続します
  include("funcs.php");
  $pdo = db_conn();

  // tryの中身を実行して、何かしらエラーが起きたら、catchの内容実行してね、という意味

  //３．データ登録SQL作成
  $stmt = $pdo->prepare("INSERT INTO gs_user_table(name,lid,lpw,kanri_flg,life_flg)VALUES(:name,:lid,:lpw,0,0)");
  $stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
  $stmt->bindValue(':lid', $lid, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
  $stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
  $status = $stmt->execute();

  //４．データ登録処理後
  if($status==false){
    echo '<script>alert("全ての項目を正しくご入力ください")</script>';
  }else{
//2. データ登録SQL作成
//* PasswordがHash化→条件はlidのみ！！
$stmt = $pdo->prepare("select * from gs_user_table where lid = :lid");
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
// $stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合STOP
if($status==false){
    sql_error($stmt);
}

//4. 抽出データ数を取得
$val = $stmt->fetch();

$_SESSION["id"]        = $val['id'];
$_SESSION["chk_ssid"]  = session_id();
$_SESSION["kanri_flg"] = $val['kanri_flg'];
$_SESSION["name"]      = $val['name'];

redirect("profile.php");
}
?>
