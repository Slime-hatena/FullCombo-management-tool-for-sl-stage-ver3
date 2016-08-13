<?php
// this file is include only!
// twitter関連処理 ユーザーロード用
/*
require_once ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/twitter/twitterLoader.php");
------------------------------------------------------------------------------------------------
$consumer_key
$consumer_secret
$oauth_token
$oauth_token_secret
$isLogin
*/

require_once $_SERVER['DOCUMENT_ROOT']  . "/fcMgt4slStage/lib/TwistOAuth.phar";
require_once $_SERVER['DOCUMENT_ROOT'] . "/../undefined/fcMgt4slStage.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/../undefined/DSN.php";
session_start();

$isLogin = false;

try {
    $pdo = new PDO ( 'mysql:host=' . $dsn ['host'] . ';dbname=' . $dsn ['dbname'] . ';charset=utf8', $dsn ['user'], $dsn ['pass'], array (
    PDO::ATTR_EMULATE_PREPARES => false
    ) );
} catch ( PDOException $e ) {
    $logWrite ="unSuccessful データベースの接続中にエラーが発生しました (userLoader)
    sqlServer : connection unsuccess" . $e->getMessage ();
    include($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/log/logWriter.php");
    exit ("ユーザーデータを取得中にエラーが発生しました。管理者にお問い合わせください。");
}

//セッションがあるか確認してなければクッキーで認証する
  if (isset($_SESSION['_fcMgt4slStage'])){
      $sql = "SELECT * FROM  `svrToolUser` WHERE  `session` = ?";
      $key = $_SESSION['_fcMgt4slStage'];
  }elseif (isset($_COOKIE['_fcMgt4slStage'])){
    $sql = "SELECT * FROM  `svrToolUser` WHERE  `cookie` = ?";
    $key = $_COOKIE['_fcMgt4slStage'];
  }else{
      goto end;
  }


$stmt=$pdo->prepare($sql);
$res=$stmt->execute(
array($key));
if ($res) {
     foreach( $stmt as $p )
    {
        $query = $p ;
    }

$screen_name = $query['name'];
$oauth_token = $query['oauth_token'];
$oauth_token_secret = $query['oauth_token_secret'];
$isLogin = true;
}

try {
    $to = new TwistOAuth($consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret);
} catch(TwistException $e) {
    $logWrite ="unSuccessful oauth認証に失敗しました (userLoader)
    sqlServer : connection unsuccess" . $e->getMessage ();
    include($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/log/logWriter.php");
    exit ("ユーザーデータを取得中にエラーが発生しました。管理者にお問い合わせください。");
}

end: