<?php
// this file is include only!
// twitter関連処理 ユーザーロード用
/*
欲しいidを $getUserid = int; で指定しようね。
$useShortid がtrueなら短縮idを使用しているよ。

$getUserid = ;
$useShortiD = false;
include ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/include/getUserdata.php");
------------------------------------------------------------------------------------------------
ここに出力する変数

$id
$shortid
$name
$gameid
$cardid
$cardsrc
$bio
$charge
$rank
$prp
$level
$grade
$tsreg
$tslast
*/

require_once $_SERVER['DOCUMENT_ROOT'] . "/../undefined/DSN.php";

try {
    $pdo = new PDO ( 'mysql:host=' . $dsn ['host'] . ';dbname=' . $dsn ['dbname'] . ';charset=utf8', $dsn ['user'], $dsn ['pass'], array (
    PDO::ATTR_EMULATE_PREPARES => false,
    ));
} catch ( PDOException $e ) {
    $logWrite ="unSuccessful データベースの接続中にエラーが発生しました (twitterLoader)
    sqlServer : connection unsuccess" . $e->getMessage ();
    include($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/log/logWriter.php");
    exit ("ユーザーデータを取得中にエラーが発生しました。管理者にお問い合わせください。");
}

$q = "id";
if (isset($useShortid) && $useShortid){
    $q = "shortid";
}


$sql = "SELECT * FROM  `fcmgtuser` WHERE  `" . $q ."` = ?";
$stmt=$pdo->prepare($sql);
$res=$stmt->execute(array($getUserid));

if ($stmt->rowCount() == 1) {
    
    $query = $stmt->fetchAll()[0];
    $id = $query['id'];
    $shortid = $query['shortid'];
    $twitterid = $query["twitter"];
    $name = $query['name'];
    $gameid = $query['gameid'];
    $cardid = $query['cardid'];
    $cardsrc = $query['cardsrc'];
    $bio = $query['bio'];
    $charge = $query['charge'];
    $rank = $query['rank'];
    $prp = $query['prp'];
    $level = $query['level'];
    $grade = $query['grade'];
    $tsreg = $query['tsreg'];
    $tslast = $query['tslast'];
    $arrImas = array(
        "imas1" => $query['imas1'],
        "imas2" => $query['imas2'],
        "imas3" => $query['imas3'],
        "imas4" => $query['imas4'],
        "imas5" => $query['imas5'],
        "imas6" => $query['imas6'],
        "imas7" => $query['imas7'],        
    );
} elseif ($stmt->rowCount() >= 2){
    echo "何故か複数件のユーザーデータを取得しています。<br>もう一度ログインしてください。";
    $logWrite ="何故か複数件のユーザーデータを取得しています。
    var_dump($stmt->fetchAll()) : " . var_dump($stmt->fetchAll());
    include($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/log/logWriter.php");
    
    setcookie('_fcMgt4slStage', $cookieId ,time()-1,"/fcMgt4slStage/",$_SERVER['SERVER_NAME']);
    $_SESSION = array();
    session_destroy();

}else{
    //なかった時はなかったことを返して各自処理してもらう
    $id = null;
    
}