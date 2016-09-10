<?php
include_once ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/include/header.php");

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

$sql = "SELECT * FROM  `fcmgtuser` ORDER BY `shortid` ASC";
$stmt=$pdo->prepare($sql);
$res=$stmt->execute();

$arr = $stmt->fetchAll();
echo '
<p>このサイトに登録している全てのプロデューサーさんです。<br>
取り敢えず作ってみました。<br>
登録順で全件表示されます。<br>
プロフィールを１度も編集したことのないプロデューサーさんは表示されません。</p>
<div style="font-size : 1.2em">
';


foreach ($arr as $value) {
    if (!($value['name'] == "")){
        if ($value['level'] == ""){
            $plevel = "非公開";
        }else{
        $plevel = $value['level'];
        }
        echo '<p><a href="user.php?s=' . $value['shortid'] . '">' . $value['shortid']. '.' . $value['name'] . ' PLv.' . $plevel
        .'</a><br>' . mb_strimwidth($value['bio'], 0, 100, "...") . '</p>';
    }
}

echo '</div>';


include ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/include/ad.php");

include_once ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/include/footer.php");