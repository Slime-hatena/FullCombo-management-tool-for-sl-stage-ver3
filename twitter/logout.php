<?php

//セッションの削除
session_start();


$_SESSION = array();


if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
    $params["path"], $params["domain"],
    $params["secure"], $params["httponly"]
    );
}

session_destroy();

//クッキー削除
setcookie('_fcMgt4slStage', '' ,time()-1000,"/fcMgt4slStage/",$_SERVER['SERVER_NAME']);


echo "ログアウトしました。自動的にトップページに戻ります。";
header("Refresh: 3; URL=../index.php");
?>