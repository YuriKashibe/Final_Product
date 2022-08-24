<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preferences</title>
</head>
<body>
    <div class="preferences_container">
        <img class="logo" src="images/logo2.png" alt="ロゴ">
        <h2>あなたの興味</h2>
        <p class="preferences_message">
            あなたが興味のある項目を以下選択肢からお選び下さい(複数選択可)
        </p>
        <form action="preferences_act.php" method="post">
            <input type="checkbox" name="preferences[]" value="photoshooting"><label for="photoshooting">写真撮影</label>
            <input type="checkbox" name="preferences[]" value="shopping"><label for="shopping">買い物</label>
            <input type="checkbox" name="preferences[]" value="karaoke"><label for="karaoke">カラオケ</label>
            <input type="checkbox" name="preferences[]" value="yoga"><label for="yoga">ヨガ</label>
            <input type="checkbox" name="preferences[]" value="cuisine"><label for="cuisine">料理</label>
            <input type="checkbox" name="preferences[]" value="tennis"><label for="tennis">テニス</label>
            <input type="checkbox" name="preferences[]" value="running"><label for="running">ランニング</label>
            <input type="checkbox" name="preferences[]" value="swimming"><label for="swimming">水泳</label>
            <input type="checkbox" name="preferences[]" value="art"><label for="art">アート</label>
            <input type="checkbox" name="preferences[]" value="traveling"><label for="traveling">旅行</label>
            <input type="checkbox" name="preferences[]" value="thrill"><label for="thrill">スリル</label>
            <input type="checkbox" name="preferences[]" value="music"><label for="music">音楽</label>
            <input type="checkbox" name="preferences[]" value="alcohol"><label for="alcohol">お酒</label>
            <input type="checkbox" name="preferences[]" value="game"><label for="game">ゲーム</label>
            <div class="preferences_button"><input class="preferences_submit" type="submit" value="Continue" /></div>
        </form>
    </div>
</body>
</html>
