<?php
echo "未公開ページです";
exit();

var_dump($_POST);

//ログイン情報を取る
require_once ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/twitter/twitterLoader.php");

if (!$isLogin){
    echo "このページはログインが必要です";
    echo '<meta http-equiv="refresh" content="1;URL=./">';
    exit();
}

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
imagecreatefrompng ( 'img/prof/gameidx2.png' ),
imagecreatefrompng ( 'img/prof/plvx2.png' ),
imagecreatefrompng ( 'img/prof/prpx2.png' )
);

$img_difficult = array(
imagecreatefrompng ( 'img/difficulty/debutx2.png' ),
imagecreatefrompng ( 'img/difficulty/regularx2.png' ),
imagecreatefrompng ( 'img/difficulty/prox2.png' ),
imagecreatefrompng ( 'img/difficulty/masterx2.png' )
);

$img_rank = imagecreatefrompng ( 'img/rank_icon/' . $rank . 'x2.png' );

// 名前
$f_size = 70;
if (strlen($name) >= 16){
    $f_size = 50;
}


ImageTTFText ( $img, $f_size, 0, 10, 115, $black, $font, $name );
// ID sID
ImageTTFText ( $img, 20, 0, 5, 30, $black, $font, $id . " (" . $shortid . ")");

//自己紹介
$bio = str_replace("<br>", '', str_replace(PHP_EOL, '', mb_strimwidth( $bio, 0, 38, "...", "UTF-8" )));
ImageTTFText ( $img, 28, 0, 15, 160, $black, $font, $bio);

// 各難易度画像
imagecopy($img, $img_difficult[0], 5, 180, 0, 0, 244, 52);
imagecopy($img, $img_difficult[1], 5, 240, 0, 0, 244, 52);
imagecopy($img, $img_difficult[2], 5, 300, 0, 0, 244, 52);
imagecopy($img, $img_difficult[3], 5, 360, 0, 0, 244, 52);
ImageTTFText ( $img, 40, 0, 10, 470, $black, $font, "All");

//各楽曲id
ImageTTFText ( $img, 36, 0, 270, 222, $black, $font, $fcDifficulty["debut"]  . " / " .  $musicAll . " (" . sprintf('%0.2f',$fcDifficulty["debut"] / $musicAll * 100 ). '%)');
ImageTTFText ( $img, 36, 0, 270, 284, $black, $font, $fcDifficulty["regular"]  . " / " .  $musicAll . " (" . sprintf('%0.2f',$fcDifficulty["regular"] / $musicAll * 100 ). '%)');
ImageTTFText ( $img, 36, 0, 270, 346, $black, $font, $fcDifficulty["pro"]  . " / " .  $musicAll . " (" . sprintf('%0.2f',$fcDifficulty["pro"] / $musicAll * 100 ). '%)');
ImageTTFText ( $img, 36, 0, 270, 406, $black, $font, $fcDifficulty["master"]  . " / " .  $musicAll . " (" . sprintf('%0.2f',$fcDifficulty["master"] / $musicAll * 100 ). '%)');
ImageTTFText ( $img, 48, 0, 50, 540, $black, $font,  $a_all  . " / " .  $musicAll * 4 . " (" . sprintf('%0.2f', $a_all / ($musicAll * 4) * 100) . '%)');

imagecopy($img, $img_rank, 530, 610, 0, 0, 122,122);

imagecopy($img, $img_icons[0], 10, 590, 0, 0, 160, 50);
imagecopy($img, $img_icons[1], 10, 645, 0, 0, 160, 50);
imagecopy($img, $img_icons[2], 10, 700, 0, 0, 160, 50);

ImageTTFText ( $img, 36, 0, 200, 632, $black, $font, $gameid);
ImageTTFText ( $img, 36, 0, 200, 688, $black, $font, $level);
ImageTTFText ( $img, 36, 0, 200, 740, $black, $font, $prp);


$bnei = "©BANDAI NAMCO Entertainment Inc.  ©BNEI / PROJECT CINDERELLA";
ImageTTFText ( $img, 16, 0, 10, 800, $black, $font, $bnei);



/*
imagecopy($img, $usagi , 494, 231, 0, 0, 106, 69);

710px から
*/

$file_name = "twittercardimg/" . $userid . ".png";

imagepng ( $img, $file_name );

echo '<div style="padding: 20px;background-color: #000;"><img src="' . $file_name . '"></div>';