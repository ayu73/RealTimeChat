<?php
	//index.htmlで入力されたメッセージをDBに登録する

	//index.htmlから必要な情報を取得
	$msg = $_POST['msg'];
	$user = $_POST['user'];

	//DB接続に必要な情報
	$db = mysqli_connect('hostname', 'username', 'password', 'dbname');
	mysqli_set_charset($db, 'utf8');
	
	//DB接続, SQL文実行
	try {
		$sql = "INSERT INTO `chatlog` (user, text, date) VALUES ('$user', '$msg', NOW())";
		$result = mysqli_query($db, $sql);
	} catch (Exception $e) {
		echo $e->getMessage() . PHP_EOL;
	}
	
	//index.htmlに戻る
	header('Location: home.php');
	exit;	
?>