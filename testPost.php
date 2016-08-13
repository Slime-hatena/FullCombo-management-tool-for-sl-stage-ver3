<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/twitter/twitterLoader.php");

//（＞▽＜）

$tweet = "@tos （ ＞▽＜）＜" . date('Y年m月d日 H時i分s秒') . "だよ！ phpの接続テスト！";

    // ツイート
    $status = $to->post('statuses/update', ['status' => $tweet]);

echo "<pre>";
    var_dump($status);
echo "</pre>";