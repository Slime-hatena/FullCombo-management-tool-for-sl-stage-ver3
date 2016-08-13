<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/twitter/twitterLoader.php");
$json_music = file_get_contents("../slStageMusicDatabase/music.json");
$json_music = mb_convert_encoding($json_music, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$arr = json_decode($json_music, true);


if (!$isLogin && false){
    exit("このページはログインが必要です");
}

?>
  <html>

  <head>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
    <link rel="stylesheet" type="text/css" href="style/bgTableMusic.php">
    <link rel="stylesheet" type="text/css" href="style/table.css">
    <link rel="stylesheet" type="text/css" href="style/check.css">

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/checkAll.js"></script>


    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>

  <body>

    <form class="pure-form pure-form-aligned" action="DataPost.php" id="main" method="post" name="main">


      <div class="pure-control-group">
        <label for="name">プロデューサー名</label>
        <input id="name" maxlength="10" name="name" size="20" type="text" placeholder="">
      </div>

      <div class="pure-control-group">
        <label for="id">Twitter</label>
        <input id="id" type="text" name="twitter" size="15" placeholder="@<?php echo $screen_name ?>" disabled>
      </div>

      <div class="pure-control-group">
        <label for="gameid">ゲームID</label>
        <input id="gameid" type="text" name="game_id" size="11" placeholder="123456789" disabled>
      </div>

      <div class="pure-control-group">
        <label for="prp">PRP</label>
        <input id="prp" type="text" maxlength="4" name="prp" size="4" placeholder="">
      </div>

      <div class="pure-control-group">
        <label for="plv"><span class="br">プロデューサー</span><wbr><span class="br">レベル</span></label>
        <input id="plv" type="text" maxlength="4" name="plv" size="4" placeholder="">
      </div>

      <div class="pure-control-group">
        <label for="rank"><span class="br">プロデューサー</span>
          <wbr><span class="br">ランク</span></label>
        <select id="rank" name="rank" class="pure-input-1-1">
          <option value="1">E : 駆け出しプロデューサー</option>
          <option value="2">D : 新米プロデューサー</option>
          <option value="3">C : 普通プロデューサー</option>
          <option value="4">B : 中堅プロデューサー</option>
          <option value="5">A : 敏腕プロデューサー</option>
          <option value="6">S : 売れっ子プロデューサー</option>
          <option value="7">SS : 超売れっ子プロデューサー</option>
        </select>
      </div>
      </div>


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
            <input class="checkAll music" id="Debut" type="checkbox">
          </td>
          <td>
            <input class="checkAll music" id="Regular" type="checkbox">
          </td>
          <td>
            <input class="checkAll music" id="Pro" type="checkbox">
          </td>
          <td>
            <input class="checkAll music" id="Master" type="checkbox">
          </td>
        </tr>

        <?php

foreach ($arr as $key => $value) {
    
    echo <<<EOF
    
    <tr>
    <th class="index" id="bg{$key}">
    <div class="wrapper">{$value['name']}</div>
    </th>
    <td>
    <input class="Debut music" id="{$key}_1" name="arr[]" type="checkbox" value="{$key}_1">
    </td>
    <td>
    <input class="Regular music" id="{$key}_2" name="arr[]" type="checkbox" value="{$key}_2">
    </td>
    <td>
    <input class="Pro music" id="{$key}_3" name="arr[]" type="checkbox" value="{$key}_3">
    </td>
    <td>
    <input class="Master music" id="{$key}_4" name="arr[]" type="checkbox" value="{$key}_4">
    </td>
    </tr>

EOF;
}
?>
      </table>

&nbsp;ページ上部のメニューにある免責事項、プライバシーポリシーをよくお読みになって同意いただける場合のみご使用ください。
      <div class="pure-controls">
        <label for="cb" class="pure-checkbox">
          <input id="cb" type="checkbox"> 同意します
        </label>
      </div>

      <div class="pure-controls">
        <button type="submit" class="pure-button pure-button-primary">送信</button>
      </div>
  </body>

  </html>