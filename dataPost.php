<?php
header("Content-Type: text/html; charset=UTF-8");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/twitter/twitterLoader.php");
require_once $_SERVER['DOCUMENT_ROOT'] . "/../undefined/DSN.php";

$json_music = file_get_contents("../slStageMusicDatabase/music.json");
$json_music = mb_convert_encoding($json_music, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$arr = json_decode($json_music, true);

try {
    $pdo = new PDO ( 'mysql:host=' . $dsn ['host'] . ';dbname=' . $dsn ['dbname'] . ';charset=utf8', $dsn ['user'], $dsn ['pass'], array (
    PDO::ATTR_EMULATE_PREPARES => false
    ) );
} catch ( PDOException $e ) {
    $logWrite ="Success : true
    response : " . $response . "
    header : " . $header . "
    oauth_token : " . $query['oauth_token'] . "
    oauth_token_secret : " . $query['oauth_token_secret'] . "
    user_id : " . $query['user_id'] . "
    screen_name : " . $query['screen_name'] . "
    sqlServer : connection unsuccess" . $e->getMessage ();
    include($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/log/logWriter.php");
    
    exit ( 'connection unsuccess' . $e->getMessage () );
}


echo str_pad(" ",4096)."<br />\n";
ob_end_flush();
ob_start('mb_output_handler');
echo 'initialize : <div id="progress01"></div><br>';
echo 'registration : <div id="progress02"></div>';
echo "<hr>";

$arr_c = count($arr) * 4;
$c = 0;

//データベースを初期化(一旦フルコンしていないことにする)
foreach ($arr as $key => $value) {
    //idが少なかったら３桁0埋めする
    $key = sprintf('%03d', $key);
    for ($i=1; $i <= 4; $i++) {
        ++$c;
        $sql = 'UPDATE fcmgt4slstage SET ' . $key . "_" . $i . ' = :state WHERE id = :id';
        $stmt=$pdo->prepare($sql);
        $res=$stmt->execute(array(":state" => 0 , ":id" => $userid));
        
        if ($res) {
            $p = round ($c / $arr_c * 100,0);
            echo "<script>document.getElementById( 'progress01' ).innerHTML = '{$p}%'</script>";
        }else{
            echo '<font color="red">失敗(1) : ' . $key . "_" . $i . "  </font>";
        }
        ob_flush();
        flush();
        sleep(0.5);
    }
}



$arr_c = count($_POST['arr']);
$c = 0;

//フルコン楽曲にマークする処理
foreach ($_POST['arr'] as $key => $value){
    ++$c;
    $sql = 'UPDATE fcmgt4slstage SET ' . $value . ' = :state WHERE id = :id';
    $stmt=$pdo->prepare($sql);
    $res=$stmt->execute(array(":state" => 1 , ":id" => $userid));
    if ($res) {
        $p = round($c / $arr_c * 100,0);
        echo "<script>document.getElementById( 'progress02' ).innerHTML = '{$p}%'</script>";
    }else{
        echo '<font color="red">失敗(2) : ' . $value . "  </font>";
    }
    ob_flush();
    flush();
    sleep(0.5);
}

//プロデューサー情報を入れる処理

//プロデューサー名
$sql = 'UPDATE fcmgtuser SET name = :state WHERE id = :id';
$stmt=$pdo->prepare($sql);
$res=$stmt->execute(array(":state" => str_replace("<","",$_POST['name']) , ":id" => $userid));
if ($res) {
    echo '<font color="blue">Producer name</font><br>';
}else{
    echo '<font color="red">Producer name</font><br>';
}
ob_flush();
flush();
sleep(0.5);


// ゲームid
if (preg_match("/^[0-9]+$/", $_POST['gameid'])) {
    
    $sql = 'UPDATE fcmgtuser SET gameid = :state WHERE id = :id';
    $stmt=$pdo->prepare($sql);
    $res=$stmt->execute(array(":state" => $_POST['gameid'] , ":id" => $userid));
    if ($res) {
        echo '<font color="blue">Game ID</font><br>';
    }else{
        echo '<font color="red">Game ID</font><br>';
    }
    
} else {
    echo '<font color="red">Game ID => 半角数字ではない何かが含まれています</font><br>';
}
ob_flush();
flush();
sleep(0.5);

// Twitter
$sql = 'UPDATE fcmgtuser SET twitter = :state WHERE id = :id';
$stmt=$pdo->prepare($sql);
$res=$stmt->execute(array(":state" => $_POST['twitter'] , ":id" => $userid));
if ($res) {
    echo '<font color="blue">Twitter id</font><br>';
}else{
    echo '<font color="red">Twitter id</font><br>';
}
ob_flush();
flush();
sleep(0.5);

// プロデューサーレベル
if (preg_match("/^[0-9]+$/", $_POST['plv'])) {
    $sql = 'UPDATE fcmgtuser SET level = :state WHERE id = :id';
    $stmt=$pdo->prepare($sql);
    $res=$stmt->execute(array(":state" => $_POST['plv'] , ":id" => $userid));
    if ($res) {
        echo '<font color="blue">Producer Level</font><br>';
    }else{
        echo '<font color="red">Producer Level</font><br>';
    }
} else {
    echo '<font color="red">Producer Level => 半角数字ではない何かが含まれています</font><br>';
}
ob_flush();
flush();
sleep(0.5);

// プロデューサーレベル
if (preg_match("/^[0-9]+$/", $_POST['prp'])) {
    $sql = 'UPDATE fcmgtuser SET prp = :state WHERE id = :id';
    $stmt=$pdo->prepare($sql);
    $res=$stmt->execute(array(":state" => $_POST['prp'] , ":id" => $userid));
    if ($res) {
        echo '<font color="blue">PRP</font><br>';
    }else{
        echo '<font color="red">PRP</font><br>';
    }
} else {
    echo '<font color="red">PRP => 半角数字ではない何かが含まれています</font><br>';
}
ob_flush();
flush();
sleep(0.5);

// 名刺ID
if (preg_match("/^[a-zA-Z0-9]+$/", $_POST['cardid'])) {
    $sql = 'UPDATE fcmgtuser SET cardid = :state WHERE id = :id';
    $stmt=$pdo->prepare($sql);
    $res=$stmt->execute(array(":state" => $_POST['cardid'] , ":id" => $userid));
    if ($res) {
        echo '<font color="blue">Card ID</font><br>';
    }else{
        echo '<font color="red">Card ID</font><br>';
    }
} else {
    echo '<font color="red">Card ID => 半角英数字ではない何かが含まれています</font><br>';
}

ob_flush();
flush();
sleep(0.5);

//名刺画像は後で処理する

//担当アイドル (未実装)

//プロデューサーランク
$sql = 'UPDATE fcmgtuser SET rank = :state WHERE id = :id';
$stmt=$pdo->prepare($sql);
$res=$stmt->execute(array(":state" => $_POST['rank'] , ":id" => $userid));
if ($res) {
    echo '<font color="blue">Producer Rank</font><br>';
}else{
    echo '<font color="red">Producer Rank</font><br>';
}
ob_flush();
flush();
sleep(0.5);

//自己紹介
$bio = mb_strimwidth( $_POST['bio'], 0, 120, "", "UTF-8" );
$sql = 'UPDATE fcmgtuser SET bio = :state WHERE id = :id';
$stmt=$pdo->prepare($sql);
$bio = preg_replace("/(\r\n|\n|\r)/", "<br>$1", str_replace("<","",$bio));
$res=$stmt->execute(array(":state" => $bio , ":id" => $userid));
if ($res) {
    echo '<font color="blue">自己紹介</font><br>';
}else{
    echo '<font color="red">自己紹介</font><br>';
}
ob_flush();
flush();
sleep(0.5);


//名刺画像処理
// アップロードファイルを格納するファイルパスを指定
$filePath = "temp/";
$filename = $_FILES["cardsrc"]["name"];


if ( !($_FILES["cardsrc"]["size"] === 0 )) {
    // アップロードファイルされたテンポラリファイルをファイル格納パスにコピーする
    $result = @move_uploaded_file( $_FILES["cardsrc"]["tmp_name"], $filePath . $filename );
    if ( $result === true ) {
        
        $newFilePath = "cardimg/" . $userid . ".png";
        
        if( $_FILES["cardsrc"]["type"] == "image/jpeg" ){
            // jpgはイヤなのでpngに変換する
            $img = ImageCreateFromJPEG($filePath . $filename);
            imagepng ($img, $newFilePath , 0);
            //最後にファイル削除
            unlink($filePath . $filename);
            
        } elseif ($_FILES["cardsrc"]["type"] == "image/png" ){
            //多分この人はios勢
            rename ($filePath . $filename ,$newFilePath);
            
        } else {
            echo "jpgまたはpngがアップロードできます。<br>";
            unlink($filePath . $filename);
        }
    }
}


ob_flush();
flush();
sleep(0.5);

//名刺画像のパスをdbに入れる
if (isset($newFilePath)){
    $sql = 'UPDATE fcmgtuser SET cardsrc = :state WHERE id = :id';
    $stmt=$pdo->prepare($sql);
    $res=$stmt->execute(array(":state" => $newFilePath , ":id" => $userid));
    if ($res) {
        echo '<font color="blue">名刺画像</font><br>';
    }else{
        echo '<font color="red">名刺画像</font><br>';
    }
}else{
    echo '<font color="green">名刺画像</font><br>';
}

ob_flush();
flush();
sleep(0.5);

if(isset($_POST['deleteCard']) && $_POST['deleteCard']){
    $sql = 'UPDATE fcmgtuser SET cardsrc = :state WHERE id = :id';
    $stmt=$pdo->prepare($sql);
    $res=$stmt->execute(array(":state" => "" , ":id" => $userid));
    if ($res) {
        echo '<font color="blue">名刺画像削除</font><br>';
    }else{
        echo '<font color="red">名刺画像削除</font><br>';
    }
}

// アイドルマスターの処理

$arrImas = $_POST["imas"];

for ($i = 1; $i <= 7; $i++){
    
    if (isset($arrImas[$i]) && $arrImas[$i] === "true" ){
        // チェック入ってる
        $state = 1;
    }else{
        $state = 0;
    }
    $sql = 'UPDATE fcmgtuser SET imas' . $i . '= :state WHERE id = :id';
    $stmt=$pdo->prepare($sql);
    $res=$stmt->execute(array(":state" => $state , ":id" => $userid));
    if ($res) {
        echo '<font color="blue">第' . $i . '期</font><br>';
    }else{
        echo '<font color="red">第' . $i . '期</font><br>';
    }
}


echo "全ての処理が完了しました。自動的に移動します。";
echo '<meta http-equiv="refresh" content="1;URL=user.php?my">';

ob_flush();
flush();
sleep(0.5);