<?php
$message_array = array();

//DB接続
$mysqli = new mysqli('hostname', 'username', 'password', 'dbname');
//接続エラーのとき、エラー文
if ($mysqli->connect_errno) {
    $error_message[] = 'データの読み込みに失敗 　エラーNo.' . $mysqli->connect_errno . ' : ' . $mysqli->connect_error;
} else {

    $sql = "SELECT user, text FROM chatlog ORDER BY date";
    $res = $mysqli->query($sql);

    if ($res) {
        $message_array = $res->fetch_all(MYSQLI_ASSOC);
    }

    $mysqli->close();
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real Time Chat</title>
    <link rel="stylesheet" href="home.css">
</head>

<body>
    <form method="POST" action="chat.php">
        <div id="talk">
            <div class="chat">
                ユーザ名:
                <div id="user">
                    <input type="text" name="user">
                </div>
                メッセージ:
                <div id="msg">
                    <input type="text" name="msg">
                </div>
                <div id="send_msg">
                    <input type="submit" name="send">
                </div>
            </div>
            <section>
                <?php if (!empty($message_array)) :  //取得したデータを格納した配列内が空でないとき

                    foreach ($message_array as $value) :
                        echo "<p>" . $value['user'];
                        echo "<span>" . $value['text'] . "</span></p>";
                    endforeach;
                endif; ?>
            </section>
        </div>
    </form>
</body>

</html>