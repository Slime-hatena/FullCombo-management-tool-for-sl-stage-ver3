<?php
print<<<EOF
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="style/table.css">
<title>Allmusic</title>
</head>
<body>
EOF;

$json_music = file_get_contents("../slStageMusicDatabase/music.json");
$json_music = mb_convert_encoding($json_music, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');

$arr = json_decode($json_music, true);

foreach ($arr as $key => $value) {
    
    

print<<<EOF
<table border="">
<tr>
<td  class="img" rowspan="2" width="100px" height="100px"><img src="../slStageMusicDatabase{$value['thumbnail']}"></td>
<td class="name" colspan="4" width="200px">{$value['name']}</td>
<td class="type">{$value['type']}</td>
</tr>
<tr>
<td class="lv_debut" width="50px">5</td>
<td class="lv_regular" width="50px">10</td>
<td class="lv_pro" width="50px">15</td>
<td class="lv_master" width="50px">20</td>
<td class="lv_plus" width="50px">-</td>
</tr>

</table>

EOF;

}



echo "<pre>";
print_r($arr);
echo "</pre>";



print<<<EOF
</body>
</html>
EOF;
