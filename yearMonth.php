<?php

$ymm = isset($_GET['ym']) ? $_GET['ym'] : date("Y-m");

require_once('class.php');

$cal = new Database();
$cal->conect();
$cal->create_title($ymm);


$count_blog = count($cal->blog_data);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>カレンダー</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div id = "whiteback">
		<table>
			<thead>
			<tr><th><h2>Time</h2></th><th><h2>Title</h2></th></tr>
			</thead>
			<tbody>
				<?php for($w = 1; $w <= $count_blog; $w++){
					echo $cal->blog_data[$w];
					}?>
		        </tbody>
	        </table>
	        <a href="index.php">Home</a>
        </div>
</body>
</head>
	 