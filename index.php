<!-- PHPの記述 -->

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>掲示板</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,400;1,300&family=Zen+Maru+Gothic&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <img src="title.jpg" alt="掲示板タイトル">
    </header>
    <nav>
        <ul>
            <li><a href="#">トップ</a></li>
            <li><a href="#">プロフィール</a></li>
            <li><a href="#">4eachについて</a></li>
            <li><a href="#">登録フォーム</a></li>
            <li><a href="#">問い合わせ</a></li>
            <li><a href="#">その他</a></li>
        </ul>
    </nav>
    <main>
        <div class="board">
            <h2 class="board-title">プログラミングに役立つ掲示板</h2>
            <form class="post-form"method="post" action="insert.php">

                <h3 class="form-head">入力フォーム</h3>

                <div class="form-group">
                    <label>ハンドルネーム</label><br>
                    <input type="text" name="handlename" class="form-input">
                </div>

                <div class="form-group">
                    <label>タイトル</label><br>
                    <input type="text" name="title" class="form-input">
                </div>

                <div class="form-group">
                    <label>コメント</label><br>
                    <textarea name="comments" class="form-textarea"></textarea>
                </div>

                <button type="submit" class="form-button">送信</button>

            </form>

            <!-- 投稿一覧 -->
            <h3 class="form-title">投稿一覧（昇順）</h3>
            <?php
            //DB接続
            $dsn='mysql:dbname=bbs_lesson;host=localhost;charset=utf8';
            $user='root';
            $password='';

            try{
                $pdo=new PDO($dsn,$user,$password);
            }catch(PDOException $e){
                exit('DB接続エラー：'.$e->getMessage());
            }

            //データ取得
            $sql="SELECT * FROM 4each_keijiban ORDER BY id ASC";
            $stmt=$pdo->query($sql);

            while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                echo"<div class='post-box'>";
                echo"<h4>".htmlspecialchars($row['title'],ENT_QUOTES,'UTF-8')."</h4>";
                echo"<p>".nl2br(htmlspecialchars($row['comments'],ENT_QUOTES,'UTF-8'))."</p>";
                echo"<p class='post-meta'>posted by".htmlspecialchars($row['handlename'],ENT_QUOTES,'UTF-8')."</p>";
                echo"</div>";
            }
            ?>
        </div>
        
        <aside class="sidebar">
            <ul>
                <li><span class="parent-title">人気の記事</span>
                    <ul>
                        <li>PHPオススメ本</li>
                        <li>PHP MyAdminの使い方</li>
                        <li>今人気のエディタTop5</li>
                        <li>HTMLの基礎</li>
                    </ul>
                </li>
                <li><span class="parent-title">オススメリンク</span>
                    <ul>
                        <li>インターノウス株式会社</li>
                        <li>XAMPPのダウンロード</li>
                        <li>Eclipseのダウンロード</li>
                        <li>Braketsのダウンロード</li>
                    </ul>
                </li>
                <li><span class="parent-title">カテゴリ</span>
                    <ul>
                        <li>HTML</li>
                        <li>PHP</li>
                        <li>MySQL</li>
                        <li>JavaScript</li>
                    </ul>
                </li>
            </ul>
        </aside>
    </main>
</body>
</html>