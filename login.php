<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<link rel="stylesheet" href="css/styling.css">
<title>ログイン</title>
</head>
<body>

<!-- login_act.php は認証処理用のPHPです。 -->
<div class="login_container">
  <img class="logo" src="images/logo2.png" alt="ロゴ">
  <form name="form1" action="login_act.php" method="post">
    <dl class=login_area>
      <dt>Login ID:</dt>
      <dd><input class="text_area" type="text" name="lid" placeholder="Enter Username" /></dd>
      <dt>Password:</dt>
      <dd><input class="text_area" type="password" name="lpw" placeholder="Enter Password"/></dd>
    </dl>
    <div class="login_button"><input type="submit" value="LOGIN" /></div>
  </form>
</div>


</body>
</html>
