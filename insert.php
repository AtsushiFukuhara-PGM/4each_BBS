<?php
//DB接続情報（XAMPPの初期設定ならroot/パスワード空）
$dsn='mysql:dbname=bbs_lesson;host=localhost;charset=utf8';
$user='root';
$password='';

try{
    $pdo=new PDO($dsn,$user,$password);
}catch(PDOException $e){
    exit('DB接続エラー：'.$e->getMessage());
}

//フォームからの値を受け取る
$handlename=$_POST['handlename'];
$title=$_POST['title'];
$comments=$_POST['comments'];

//データを挿入するSQL
$sql="INSERT INTO 4each_keijiban(handlename,title,comments) VALUES (:handlename, :title, :comments)";
$stmt=$pdo->prepare($sql);
$stmt->bindValue(':handlename',$handlename,PDO::PARAM_STR);
$stmt->bindValue(':title',$title,PDO::PARAM_STR);
$stmt->bindValue(':comments',$comments,PDO::PARAM_STR);
$stmt->execute();

//投稿後はトップページに戻す
header("Location: index.php");
exit;