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


// Twitter Card用の画像生成
$getUserid = $userid;
$useShortid = false;
include ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/include/getUserdata.php");

$json_music = file_get_contents("../slStageMusicDatabase/music.json");
$json_music = mb_convert_encoding($json_music, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$slStageMusicList = json_decode($json_music, true);

// 各難易度ごとのフルコン曲算出
$fcDifficulty = [   //フルコンした難易度別曲数
"debut" => 0,
"regular" => 0,
"pro" => 0,
"master" => 0
];
$fcLevel = [    //フルコンしたレベル別曲数
28 =>0,
27 =>0,
26 =>0,
25 =>0,
24 =>0,
23 =>0,
22 =>0,
21 =>0,
20 =>0,
19 =>0,
18 =>0,
17 =>0,
16 =>0,
15 =>0,
14 =>0,
13 =>0,
12 =>0,
11 =>0,
10 =>0,
9 =>0,
8 =>0,
7 =>0,
6 =>0,
5 =>0
];
$levelAll = [ //レベル別曲数
28 =>0,
27 =>0,
26 =>0,
25 =>0,
24 =>0,
23 =>0,
22 =>0,
21 =>0,
20 =>0,
19 =>0,
18 =>0,
17 =>0,
16 =>0,
15 =>0,
14 =>0,
13 =>0,
12 =>0,
11 =>0,
10 =>0,
9 =>0,
8 =>0,
7 =>0,
6 =>0,
5 =>0
];
$musicAll = 0;  //全曲数

$sql = "SELECT * FROM  `fcmgt4slstage` WHERE  `id` = :id";
$stmt=$pdo->prepare($sql);
$res=$stmt->execute(array(":id" =>$id));
$query = $stmt->fetchAll()[0];


$doFc = array(array()); //フルコンしてるか
for ($d = 1; $d <= 4; $d++) {
    $i = 1;   //ループ用その2
    $a = 0;  //難易度レベル一時保存用
    $b = ""; //難易度一時保存用
    $f = false;  //フルコンしたかどうか
    $mn= false; //no play
    while(isset($query[sprintf('%03d', $i) . "_" . $d])){
        
        if ($query[sprintf('%03d', $i) . "_" . $d] == 1){
            $f = true;
        }elseif ($query[sprintf('%03d', $i) . "_" . $d] == 2){
            $mn = true; // noplay
        }
        // fcLevelAll
        switch ($d) {
            case 1:
                $b = "debut";
                break;
            case 2:
                $b = "regular";
                break;
            case 3:
                $b = "pro";
                break;
            case 4:
                $b = "master";
                break;
            default:
                continue;
                break;
    }
    $a = $slStageMusicList[sprintf('%03d', $i)][$b];

    if ($f){
        $fcDifficulty[$b]++;
        $fcLevel[$a]++;
        $doFc[sprintf('%03d', $i)][$d] = 'do_fc';
    }elseif ($mn){
        $doFc[sprintf('%03d', $i)][$d] = 'no_play';
    }else{
        $doFc[sprintf('%03d', $i)][$d] = '';
    }
    $levelAll[$a]++;
    $i++;
    $f = false;
    $mn = false;
}
}
$musicAll = $i - 1;

$a_all = $fcDifficulty["debut"] + $fcDifficulty["regular"] + $fcDifficulty["pro"] + $fcDifficulty["master"];


/*
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

$font = 'font/mplus-2c-regular.ttf';
$img = imagecreatefrompng ( 'img/twitter_card/bg.png' );
$usagi = imagecreatefrompng ( 'img/twitter_card/usagi.png' );
$black = ImageColorAllocate ( $img, 0x00, 0x00, 0x00 );

$img_icons = array(
imagecreatefrompng ( 'img/prof/gameid.png' ),
imagecreatefrompng ( 'img/prof/plv.png' ),
imagecreatefrompng ( 'img/prof/prp.png' )
);

$img_difficult = array(
imagecreatefrompng ( 'img/difficulty/debut.png' ),
imagecreatefrompng ( 'img/difficulty/regular.png' ),
imagecreatefrompng ( 'img/difficulty/pro.png' ),
imagecreatefrompng ( 'img/difficulty/master.png' )
);

$img_rank = imagecreatefrompng ( 'img/rank_icon/' . $rank . '.png' );


ImageTTFText ( $img, 36, 0, 10, 60, $black, $font, $_POST['name'] );
ImageTTFText ( $img, 10, 0, 5, 15, $black, $font, $id . " (" . $shortid . ")");

$bio = str_replace("<br>", '', str_replace(PHP_EOL, '', mb_strimwidth( $bio, 0, 64, "...", "UTF-8" )));
ImageTTFText ( $img, 14, 0, 15, 85, $black, $font, $bio );

imagecopy($img, $img_difficult[0], 5, 100, 0, 0, 122, 26);
imagecopy($img, $img_difficult[1], 5, 130, 0, 0, 122, 26);
imagecopy($img, $img_difficult[2], 5, 160, 0, 0, 122, 26);
imagecopy($img, $img_difficult[3], 5, 190, 0, 0, 122, 26);
ImageTTFText ( $img, 28, 0, 10, 261, $black, $font, "All");


ImageTTFText ( $img, 18, 0, 140, 121, $black, $font, $fcDifficulty["debut"]  . " / " .  $musicAll . " (" . sprintf('%0.2f',$fcDifficulty["debut"] / $musicAll * 100 ). '%)');
ImageTTFText ( $img, 18, 0, 140, 151, $black, $font, $fcDifficulty["regular"]  . " / " .  $musicAll . " (" . sprintf('%0.2f',$fcDifficulty["regular"] / $musicAll * 100 ). '%)');
ImageTTFText ( $img, 18, 0, 140, 181, $black, $font, $fcDifficulty["pro"]  . " / " .  $musicAll . " (" . sprintf('%0.2f',$fcDifficulty["pro"] / $musicAll * 100 ). '%)');
ImageTTFText ( $img, 18, 0, 140, 211, $black, $font, $fcDifficulty["master"]  . " / " .  $musicAll . " (" . sprintf('%0.2f',$fcDifficulty["master"] / $musicAll * 100 ). '%)');
ImageTTFText ( $img, 26, 0, 80, 260, $black, $font,  $a_all  . " / " .  $musicAll * 4 . " (" . sprintf('%0.2f', $a_all / ($musicAll * 4) * 100) . '%)');

imagecopy($img, $img_rank, 520, 6, 0, 0, 61, 61);
imagecopy($img, $img_icons[0], 400, 95, 0, 0, 80, 25);
imagecopy($img, $img_icons[1], 400, 155, 0, 0, 80, 25);
imagecopy($img, $img_icons[2], 400, 185, 0, 0, 79, 25);

ImageTTFText ( $img, 18, 0, 410, 146, $black, $font, $gameid);
ImageTTFText ( $img, 18, 0, 500, 177, $black, $font, $level);
ImageTTFText ( $img, 18, 0, 500, 207, $black, $font, $prp);

imagecopy($img, $usagi , 494, 231, 0, 0, 106, 69);

$bnei = "©BANDAI NAMCO Entertainment Inc.  ©BNEI / PROJECT CINDERELLA";
ImageTTFText ( $img, 10, 0, 10, 285, $black, $font, $bnei);

$file_name = "twittercardimg/" . $userid . ".png";

imagepng ( $img, $file_name );

echo "全ての処理が完了しました。自動的に移動します。";
echo '<meta http-equiv="refresh" content="1;URL=user.php?my">';

ob_flush();
flush();
sleep(0.5);