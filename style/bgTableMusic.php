<?php
$json_music = file_get_contents("../../slStageMusicDatabase/music.json");
$json_music = mb_convert_encoding($json_music, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$arr = json_decode($json_music, true);

$writeFileName = "bgTableMusic.css";

if (file_exists($writeFileName)){
    if (unlink($writeFileName)){
        echo "ファイル削除成功<br>";
    }else{
        echo "ファイル削除失敗<br>";
    }
}

if (touch($writeFileName)){
    echo "ファイル生成成功<br>";
}else{
    echo "ファイル生成失敗<br>";
}

$fp = fopen($writeFileName , "w");
$writeString = "";

foreach ($arr as $key => $value) {
$writeString = $writeString . ' #bg' . $key . '{ background: url("../../slStageMusicDatabase' . $value["banner"] . '")}
';
}

$res = fwrite($fp, $writeString);

if ($res){
	echo "書き込み成功";
} else{
	echo "書き込み失敗";
}

fclose($fp);