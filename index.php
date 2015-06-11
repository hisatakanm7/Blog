<?php

//エスケープ
require_once('class.php');
$cal = new Database();


function h($s) {
	return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}

//セキュリティ
session_start();


if ($_SERVER['REQUEST_METHOD'] != 'POST') {
	if(!isset($_SESSION['token'])){
		$_SESSION['token'] = sha1(uniqid(mt_rand(), true));
	}
} else {
	if (empty($_POST['token']) || $_POST['token'] != $_SESSION['token']){
		echo "不正な操作です！";
		exit;
	}
	
//データベース接続
try {
    $dbh = new PDO('mysql:host=localhost;dbname=blog_app','dbuser','yuki4416');
} catch (PDOException $e) {
    var_dump($e->getMessage());
    exit;
}

//データベースに値の挿入
$sql = "insert into users
(title, times, sentence,timeYM)
values
(:title, :times, :sentence,:timeYM)
";

$contents = $_POST['sentence'];
$contents = nl2br($contents);

$stmt = $dbh->prepare($sql);
$params = array(
":title" => $_POST['title'],
":times" => date("Y-m-d H:i:s"),
":sentence" => $contents,
":timeYM" => date("Y-m",time())
);

if ($stmt->execute($params)) {
	            $msg = "投稿完了";
	        } else {
	            $err = "投稿できませんでした";
	        }
        }
        
        
        

        $cal->conect();
        
        

//GETでカレンダーの年を抽出

$ymm = isset($_GET['ym']) ? $_GET['ym'] : date("Y-m");
 
$timeStamp = strtotime($ymm . "-01");
 
if ($timeStamp === false) {
    $timeStamp = time();
}

//前月、翌月へのリンク
$prev = date("Y", mktime(0,0,0,date("m",$timeStamp),1,date("Y",$timeStamp)-1));
$next = date("Y", mktime(0,0,0,date("m",$timeStamp)+1,1,date("Y",$timeStamp)+1));


//記事がある月に詳細のリンクをつくる
$cal->create_month($timeStamp);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>ブログ</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>

	<div id ="whiteback">
	
		<div id="calender">
			<h1>エンジニア日記</h1>
			<?php if (!empty($msg)) : ?>
				<p style="color:green"><?php echo h($msg); ?></p>
			<?php endif; ?>
			<form action="" method="POST">
				<p>題名：<input type = "text" size ="20" name = "title"></p>
				<p>本文：<textarea name = "sentence" cols="40" rows="20"></textarea></p>
				<p><input type = "submit" value = "送信"></p>
				<input type="hidden" name="token" value="<?php echo h($_SESSION['token']); ?>">
			</form>
		</div>
	
		<p><a href="?ym=<?php echo $prev; ?>">前年</a></p>
		<p><?php echo date("Y",$timeStamp); ?> 年</p>
		<p><a href="?ym=<?php echo $next; ?>">翌年</a></p>
		<p><?php echo $cal->month[1];?>月</p>
		<p><?php echo $cal->month[2];?>月</p>
		<p><?php echo $cal->month[3];?>月</p>
		<p><?php echo $cal->month[4];?>月</p>
		<p><?php echo $cal->month[5];?>月</p>
		<p><?php echo $cal->month[6];?>月</p>
		<p><?php echo $cal->month[7];?>月</p>
		<p><?php echo $cal->month[8];?>月</p>
		<p><?php echo $cal->month[9];?>月</p>
		<p><?php echo $cal->month[10];?>月</p>
		<p><?php echo $cal->month[11]; ?>月</p>
		<p><?php echo $cal->month[12];?>月</p>
	</div>
</body>