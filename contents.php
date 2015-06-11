<?php
$ymm = isset($_GET['ym']) ? $_GET['ym'] : date("Y-m");

require_once('class.php');

$cal = new Database();
$cal->conect();
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
	<h2><?php echo $cal->title[$ymm]; ?></h2>
	<p><?php echo $cal->tim[$ymm]; ?></p>
	<p><?php echo $cal->sentence[$ymm]; ?></p>
	<a href="index.php">Home</a>
</div>
</body>
     
