<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styling2.css">
    <title>Sign up</title>
</head>
<body>

 <div class="signup_container">
    <img class="logo" src="images/logo2.png" alt="ロゴ">
    <p class="signup_message">まずは会員登録から</p>
    <div>
            <form class="signup_form" action="signup_act.php" method="post">
            <dl class="signup_area">
            <dt>Full Name:</dt>
            <dd><input class="text_area" type="text" name="name" placeholder="Enter your name" /></dd>
            <dt>Username:</dt>
            <dd><input class="text_area" type="text" name="lid" placeholder="Enter Username" /></dd>
            <dt>Password:</dt>
            <dd><input class="text_area" type="password" name="lpw" placeholder="Enter Password"/></dd>
            </dl>
            <div class="signup_button"><input class="signup_submit" type="submit" value="SIGN UP" /></div>
        </form>
    </div>
    <a class="login_link" href="login.php">既に会員ですか？こちらからログイン</a>
 </div>

</body>
</html>
