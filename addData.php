<?php
$json_music = file_get_contents("../slStageMusicDatabase/music.json");
$json_music = mb_convert_encoding($json_music, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$arr = json_decode($json_music, true);
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style/bgTableMusic.php">
</head>
<body>

  <form action="DataPost.php" id="main" method="post" name="main">
    <p>
      P名
      <br> &ensp;
      <input maxlength="10" name="name" size="20" type="text">
      <br> Twitter
      <br> &ensp;＠
      <input maxlength="15" name="twitter" size="15" type="text" value="<?php if (isset ( $user->screen_name )) { echo $user->screen_name; } ?>">
      <br> PRP
      <br> &ensp;
      <input maxlength="4" name="prp" size="4" type="text">
      <br> PLv
      <br> &ensp;
      <input maxlength="4" name="plv" size="4" type="text">
      <br> ゲームid
      <br> &ensp;
      <input maxlength="9" name="game_id" size="11" type="text">
      <br> <span style="font-size: 85%"><b>PRPとPLv ゲームidは入力されていないと*に置き換わります。</b></span>
    </p>
    P Rank
    <br> &ensp;
    <select name="p_rank">
      <option value="0">F : 見習いプロデューサー</option>
      <option value="1">E : 駆け出しプロデューサー</option>
      <option value="2">D : 新米プロデューサー</option>
      <option value="3">C : 普通プロデューサー</option>
      <option value="4">B : 中堅プロデューサー</option>
      <option value="5">A : 敏腕プロデューサー</option>
      <option value="6">S : 売れっ子プロデューサー</option>
      <option value="7">SS : 超売れっ子プロデューサー</option>
    </select>


    <table cellpadding="5" cellspacing="1" rules="cols">
      <tr>
        <th class="heading">-</th>
        <td class="heading">Debut</td>
        <td class="heading">Regular</td>
        <td class="heading">Pro</td>
        <td class="heading">Master</td>
      </tr>
      <tr>
        <th class="heading">難易度ごとに全てチェック</th>
        <td>
          <input class="checkAll" id="Debut" type="checkbox">
        </td>
        <td>
          <input class="checkAll" id="Regular" type="checkbox">
        </td>
        <td>
          <input class="checkAll" id="Pro" type="checkbox">
        </td>
        <td>
          <input class="checkAll" id="Master" type="checkbox">
        </td>
      </tr>

 <?php

foreach ($arr as $key => $value) {
    print<<<EOF
    <tr>
    <th class="index" id="bg{$key}">
    <div class="wrapper">{$value['name']}</div>
    </th>
    <td>
    <input class="Debut" id="{$key}_1" name="arr[]" type="checkbox" value="{$key}_1">
    </td>
    <td>
    <input class="Regular" id="{$key}_2" name="arr[]" type="checkbox" value="{$key}_2">
    </td>
    <td>
    <input class="Pro" id="{$key}_3" name="arr[]" type="checkbox" value="{$key}_3">
    </td>
    <td>
    <input class="Master" id="{$key}_4" name="arr[]" type="checkbox" value="{$key}_4">
    </td>
    </tr>
EOF;
}
    
    ?>

    </table>
    </body>
    </html>
