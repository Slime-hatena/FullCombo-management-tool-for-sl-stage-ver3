<?php
$json_music = file_get_contents("../slStageMusicDatabase/music.json");
$json_music = mb_convert_encoding($json_music, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');

$arr = json_decode($json_music, true);


print<<<EOM



<table>
    <thead>
    <tr><th>
    </thead>

</table>

EOM;




echo "<pre>";
print_r($arr);
echo "</pre>";