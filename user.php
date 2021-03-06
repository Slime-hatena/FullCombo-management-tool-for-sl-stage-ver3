<?php

//ログイン情報を取る
require_once ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/twitter/twitterLoader.php");


//何を使ってユーザーを判定するか
if( array_key_exists( 'my',$_GET )) {
    //マイページを表示
    
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/twitter/twitterLoader.php");
    
    if (!$isLogin){
        include_once ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/include/header.php");
        echo "このページはログインが必要です";
        include_once ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/include/footer.php");
        exit();
    }
    
    if (isset($userid)){
        $getUserid = $userid;
        $useShortid = false;
        include ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/include/getUserdata.php");
    }
    
}elseif( array_key_exists( 'id',$_GET )) {
    //get->idで判定
    $getUserid = $_GET['id'];
    $useShortid = false;
    
}elseif( array_key_exists( 's',$_GET ) ) {
    //get->sで判定
    $getUserid = $_GET['s'];
    $useShortid = true;
    
}else{
    echo '<meta http-equiv="refresh" content="0;URL=index.php">';
    include_once ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/include/footer.php");
    exit();
}

include ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/include/getUserdata.php");

if($id == null){
    include_once ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/include/header.php");
    echo 'このユーザーは存在しません。<br>';
    echo '(0' . $useShortid . ')' . $getUserid;
    include_once ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/include/footer.php");
    exit();
}



$json_music = file_get_contents("../slStageMusicDatabase/music.json");
$json_music = mb_convert_encoding($json_music, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$slStageMusicList = json_decode($json_music, true);

/*
foreach ($slStageMusicList as $key => $value) {
    echo gettype($key) . "<br>";
    if(gettype($key) == "integer"){
        echo "変換" . $key;
        $slStageMusicList[(string)$key] = $slStageMusicList[$key];
        unset($slStageMusicList[$key]);
    }
}
// ここを記述した
*/

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
    $a = $slStageMusicList[$i][$b];
    
    if ($f){
        $fcDifficulty[$b]++;
        $fcLevel[$a]++;
        $doFc[$i][$d] = 'do_fc';
    }elseif ($mn){
        $doFc[$i][$d] = 'no_play';
    }else{
        $doFc[$i][$d] = '';
    }
    $levelAll[$a]++;
    $i++;
    $f = false;
    $mn = false;
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

$a_all = $fcDifficulty["debut"] + $fcDifficulty["regular"] + $fcDifficulty["pro"] + $fcDifficulty["master"];

include_once ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/include/header.php");




print<<<EOF
<span class="userid">UserID : {$id}&nbsp;({$shortid})&nbsp;<a href="https://twitter.com/{$twitterid}" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i>@{$twitterid}</a></span><br>
<span class="user_name">{$name}</span><hr class="under_line">

<div class="bio">{$bio}</div>

<div class="user_over">
<div class="gameid"><img src="img/prof/gameid.png" class="gameid_img"><span class="gameid_text">{$gameid}</span></div>
<div class="user_left">
<div class="prp"><img src="img/prof/prp.png" class="prp_img"><span class="prp_text">{$prp}</span></div>
<div class="plv"><img src="img/prof/plv.png" class="prp_img"><span class="prp_text">{$level}</span></div>
</div>
<div class="user_right">
<div class="rank"><img src="img/rank_icon/{$rank}.png" class="rank_icon"></div>
</div>
</div>
EOF;


echo '<div class="idolmaster">';
foreach ($arrImas as $key => $value) {
    if ($value == 1){
        echo '<span class="idolmaster_img"><img src="img/idolmaster/' . $key . '.png" class="idolmaster_icon"></span>';
    }
}
echo '</div>';



echo '<br><div class="difficulty">
<div class="d_debut"><img src="img/difficulty/debut.png" class="difficulty_img">&nbsp;<span class="difficulty_result">'  . $fcDifficulty["debut"]  . " / " .  $musicAll . '</span><span class="difficulty_per">' . sprintf('%0.2f', $fcDifficulty["debut"] / $musicAll * 100) . '%</span></div>
<div class="d_regular"><img src="img/difficulty/regular.png" class="difficulty_img">&nbsp;<span class="difficulty_result">' . $fcDifficulty["regular"]  . " / " .  $musicAll . '</span><span class="difficulty_per">' .  sprintf('%0.2f',$fcDifficulty["regular"] / $musicAll * 100 ). '%</span></div>
<div class="d_pro"><img src="img/difficulty/pro.png" class="difficulty_img">&nbsp;<span class="difficulty_result">' . $fcDifficulty["pro"]  . " / " .  $musicAll . '</span><span class="difficulty_per">' . sprintf('%0.2f', $fcDifficulty["pro"] / $musicAll * 100 ). '%</span></div>
<div class="d_master"><img src="img/difficulty/master.png" class="difficulty_img">&nbsp;<span class="difficulty_result">' . $fcDifficulty["master"]  . " / " .  $musicAll . '</span><span class="difficulty_per">' . sprintf('%0.2f', $fcDifficulty["master"] / $musicAll * 100) . '%</span></div>
<div class="d_all">&nbsp;<span class="difficulty_text">All</span>&nbsp;<span class="difficulty_result">' . $a_all  . " / " .  $musicAll * 4 . '</span><span class="difficulty_per">' . sprintf('%0.2f', $a_all / ($musicAll * 4) * 100) . '%</span></div>
</div> <hr>';




if (!($cardsrc ===  "")){
    echo '
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
    ';
}

include ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/include/ad.php");

// 名刺ID コピーできるようにする
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

//並び替え 並び替えると勝手に添字が振り直されるので 一旦keyをstringに変えたい
$newArr = array();
foreach ($slStageMusicList as $key => $value){
    $sortKey[$key] = $value['order'];
    // keyに'_'を付与
    $newArr[$key . "_"] = $value;
}
$slStageMusicList = $newArr;
array_multisort ( $sortKey , SORT_ASC, SORT_NUMERIC , $slStageMusicList);
// intに戻す かなり冗長だけど取り急ぎ
$newArr = array();
foreach ($slStageMusicList as $key => $value) {
    $newArr[str_replace('_', '', $key)] = $value;
}
$slStageMusicList = $newArr;



foreach ($slStageMusicList as $key => $value) {

    print<<<EOF
    
    <tr>

EOF;

    echo '<td class="title" id="bg' . sprintf('%03d', $key) .'">';

    print<<<EOF

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
$tweetStr = $name . "さんのフルコンボ曲数は" .
$a_all  . "/" .  $musicAll * 4 . "(" . sprintf('%0.2f', $a_all / ($musicAll * 4) * 100) . '%)です。' .
'#fcMgt4slStage #デレステ 詳細→';

echo '<div class="Information">共有用URL<br>
通常 : http://svr.aki-memo.net/fcMgt4slStage/user.php?id=' . $id .  '<br>
短縮 : http://svr.aki-memo.net/fcMgt4slStage/user.php?s=' . $shortid .  '<br>

';



print<<<EOF
<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://svr.aki-memo.net/fcMgt4slStage/user.php?id={$id}" data-text="{$tweetStr}" data-lang="ja" data-size="large">ツイート</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
</div>
EOF;


include ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/include/ad.php");

include_once ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/include/footer.php");

?>