create table users(
id int,
title varchar(255),
times datetime,
sentence text
);

try{ $dbh =new PDO('mysql:host=localhost;dbname=blog_app','dbuser','yuki4416');
}cathc(PDOException $e){
	var_dump($e->getMessage());
	exit;
}
