<?php
include_once ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/include/header.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/twitter/twitterLoader.php");

if (!$isLogin){
    echo "このページはログインが必要です";
    include_once ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/include/footer.php");
    exit();
}

if (isset($userid)){
    $getUserid = $userid;
    $useShortid = false;
    include ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/include/getUserdata.php");
}


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
    $f = true;  //フルコンしたかどうか
    while(isset($query[sprintf('%03d', $i) . "_" . $d])){
        
        if (!($query[sprintf('%03d', $i) . "_" . $d] == 1)){
            $f = false;
        }
        
        
        // /fcLevelAll
        
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
    }else{
        $doFc[sprintf('%03d', $i)][$d] = '';
    }
    $levelAll[$a]++;
    $i++;
    $f = true;
}
}
$musicAll = $i - 1;

/*
echo
$id.
$shortid.
$name.
$gameid.
$cardid.
$cardsrc.
$bio.
$charge.
$rank.
$prp.
$level.
$grade.
$tsreg.
$tslast;


Twitter を受け取るようにする

*/


print<<<EOF
<p><span class="userid">UserID : {$id}&nbsp;({$shortid})&nbsp;<a href="https://twitter.com/{$screen_name}" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i>@{$twitterid}</a></span></p>
<p><span class="user_name">{$name}</span><hr class="under_line"></p>

<p><div class="bio">{$bio}</div></p>

<div class="user_over">
<p><div class="gameid"><img src="img/prof/gameid.png" class="gameid_img"><span class="gameid_text">{$gameid}</span></div></p>
<div class="user_left">
<p><div class="prp"><img src="img/prof/prp.png" class="prp_img"><span class="prp_text">{$prp}</span></div></p>
<p><div class="plv"><img src="img/prof/plv.png" class="prp_img"><span class="prp_text">{$level}</span></div></p>
</div>
<div class="user_right">
<p><div class="rank"><img src="img/rank_icon/{$rank}.png" class="rank_icon"></div></p>
</div>
</div>
EOF;

$a_all = $fcDifficulty["debut"] + $fcDifficulty["regular"] + $fcDifficulty["pro"] + $fcDifficulty["master"];


echo '<div class="difficulty">
<p><div class="d_debut"><img src="img/difficulty/debut.png" class="difficulty_img">&nbsp;<span class="difficulty_result">'  . $fcDifficulty["debut"]  . " / " .  $musicAll . '</span><span class="difficulty_per">' . sprintf('%0.2f', $fcDifficulty["debut"] / $musicAll * 100) . '%</span></div></p>
<p><div class="d_regular"><img src="img/difficulty/regular.png" class="difficulty_img">&nbsp;<span class="difficulty_result">' . $fcDifficulty["regular"]  . " / " .  $musicAll . '</span><span class="difficulty_per">' .  sprintf('%0.2f',$fcDifficulty["regular"] / $musicAll * 100 ). '%</span></div></p>
<p><div class="d_pro"><img src="img/difficulty/pro.png" class="difficulty_img">&nbsp;<span class="difficulty_result">' . $fcDifficulty["pro"]  . " / " .  $musicAll . '</span><span class="difficulty_per">' . sprintf('%0.2f', $fcDifficulty["pro"] / $musicAll * 100 ). '%</span></div></p>
<p><div class="d_master"><img src="img/difficulty/master.png" class="difficulty_img">&nbsp;<span class="difficulty_result">' . $fcDifficulty["master"]  . " / " .  $musicAll . '</span><span class="difficulty_per">' . sprintf('%0.2f', $fcDifficulty["master"] / $musicAll * 100) . '%</span></div></p>
<p><div class="d_all"><span class="difficulty_text">&nbsp;All</span>&nbsp;<span class="difficulty_result">' . $a_all  . " / " .  $musicAll * 4 . '</span><span class="difficulty_per">' . sprintf('%0.2f', $a_all / ($musicAll * 4) * 100) . '%</span></div></p>
</div> <hr>';




if (!($cardsrc ===  "")){
    echo '<p>
    <div class="copy_guard">
    <span class="img_Guard"></span>
    <img class="card"  src="' .$cardsrc .  '" alt="" title="名刺" />
    </div>
    ';
}
if (!($cardid ===  "")){
    echo '
    <form class="pure-form pure-form-aligned">
    <div class="pure-control-group cardid">
    <label for="cardid">名刺ID</label>
    <input id="cardid" type="text" maxlength="10" name="cardid" size="11" placeholder="" value="' . $cardid . '" readonly>
    </div>
    </form>
    </p>
    ';
}

print<<<EOF


<table class="tableSorter">
<tr class="heading_tr">
<th class="heading">Title<br></th>
<th class="heading">Debut<br></th>
<th class="heading">Regular<br></th>
<th class="heading">Pro<br></th>
<th class="heading">Master<br></th>
</tr>

EOF;

$musicLevel = array();  //一時用
foreach ($slStageMusicList as $key => $value) {
    
    
    
    print<<<EOF
    
    <tr>
    <td class="title" id="bg{$key}">
    <div class="tableWrapper">{$value['name']}</div>
    </td>
    <td class="box_cell {$doFc[$key][1]}">
    <div>{$value["debut"]}</div>
    </td>
    <td class="box_cell {$doFc[$key][2]}">
    <div>{$value["regular"]}</div>
    </td>
    <td class="box_cell {$doFc[$key][3]}">
    <div>{$value["pro"]}</div>
    </td>
    <td class="box_cell {$doFc[$key][4]}">
    <div>{$value["master"]}</div>
    </td>
    </tr>
    
EOF;
    
}

echo  "</table>";

//コピー用URLを生成

echo '<div class="Information"><b>共有用URL</b><br>
<b>通常 : </b>http://svr.aki-memo.net/fcMgt4slStage/user.php?id=' . $id .  '<br>
<b>短縮 : </b>http://svr.aki-memo.net/fcMgt4slStage/user.php?s=' . $shortid .  '
</div>
';



include_once ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/include/footer.php");