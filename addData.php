<?php
include_once ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/include/header.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/twitter/twitterLoader.php");

if (isset($userid)){
    $getUserid = $userid;
    $useShortid = false;
    include ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/include/getUserdata.php");
}


$json_music = file_get_contents("../slStageMusicDatabase/music.json");
$json_music = mb_convert_encoding($json_music, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$arr = json_decode($json_music, true);



if (!$isLogin){
    echo "このページはログインが必要です";
    include_once ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/include/footer.php");
    exit();
}

// ランク関連
$selectRank = array("","","","","","","","","");
$selectRank[$rank] = "selected";

$selectImas = array("","","","","","","","");
$i = 1;

foreach ($arrImas as $key => $value) {
  if ($value === 1){
    $selectImas[$i] = "checked";
  }
  $i++;
}


?>

  <p>アカウントに各データを登録します。
    <br>すべてを入力する必要はありません。
    <br>非公開にしたいデータは空白または0で送信してください。</p>

  <form class="pure-form pure-form-aligned" action="dataPost.php" id="main" method="post" name="main" enctype="multipart/form-data">


    <div class="pure-control-group">
      <label for="name">プロデューサー名</label>
      <input id="name" maxlength="10" name="name" size="20" type="text" placeholder="" value="<?php echo $name ?>">
    </div>

    <div class="pure-control-group">
      <label for="id">Twitter</label>
      <input id="id" type="text" name="twitter" size="15" value="<?php echo $screen_name ?>" readonly>
    </div>

    <div class="pure-control-group">
      <label for="gameid">ゲームID</label>
      <input id="gameid" type="text" name="gameid" maxlength="9" size="11" placeholder="" value="<?php echo $gameid ?>">
    </div>

    <div class="pure-control-group">
      <label for="plv"><span class="br">プロデューサー</span>
        <wbr><span class="br">レベル</span></label>
      <input id="plv" type="text" maxlength="4" name="plv" size="4" placeholder="" value="<?php echo $level ?>">
    </div>

    <div class="pure-control-group">
      <label for="prp">PRP</label>
      <input id="prp" type="text" maxlength="4" name="prp" size="4" placeholder="" value="<?php echo $prp ?>">
    </div>

    <div class="pure-control-group">
      <label for="cardid">名刺ID</label>
      <input id="cardid" type="text" maxlength="10" name="cardid" size="11" placeholder="" value="<?php echo $cardid ?>">
    </div>

    <div class="pure-control-group">
      <label for="cardsrc">名刺画像</label>
      <input type="file" id="cardsrc" name="cardsrc">
    </div>

    <div class="pure-control-group">
      <label for="cb">名刺を削除する : </label>
      <input type="checkbox" id="cb" name="deleteCard" value="false">
    </div>

    <div class="pure-control-group">
      <label for="rank"><span class="br">担当</span>
        <wbr><span class="br">アイドル</span></label>
      <select id="rank" name="rank" class="pure-input-1-1" size="1">
        <option value="0000">準備中</option>
      </select>
    </div>

    <div class="pure-control-group">
      <label for="rank"><span class="br">プロデューサー</span>
        <wbr><span class="br">ランク</span></label>
      <select id="rank" name="rank" class="pure-input-1-1" size="1">
        <option value="0" <?php echo $selectRank[0] ?>>非公開</option>
        <option value="1" <?php echo $selectRank[1] ?>>E : 駆け出しプロデューサー</option>
        <option value="2" <?php echo $selectRank[2] ?>>D : 新米プロデューサー</option>
        <option value="3" <?php echo $selectRank[3] ?>>C : 普通プロデューサー</option>
        <option value="4" <?php echo $selectRank[4] ?>>B : 中堅プロデューサー</option>
        <option value="5" <?php echo $selectRank[5] ?>>A : 敏腕プロデューサー</option>
        <option value="6" <?php echo $selectRank[6] ?>>S : 売れっ子プロデューサー</option>
        <option value="7" <?php echo $selectRank[7] ?>>SS : 超売れっ子プロデューサー</option>
        <option value="8" <?php echo $selectRank[8] ?>>SSS : アイドルマスター</option>
      </select>
    </div>

    <div class="pure-control-group">
      <label for="bio">自己紹介
        <br>(120文字)</label>
      <textarea maxlength="120" id="bio" name="bio" placeholder="" rows="3" cols="25"><?php echo str_replace("<br>","",$bio) ?></textarea>
    </div>

    <div onclick="obj=document.getElementById('open').style; obj.display=(obj.display=='none')?'block':'none';">
<a style="cursor:pointer; font-size: 1.2em;">▼ SSS : アイドルマスター(クリックで展開)</a>
</div>
 
<!-- 折りたたみ -->
<div id="open" style="display:none;clear:both;">


  <div class="pure-control-group">
      <label for="imas1">第１期<br>アイドルマスター</label>
      <input type="checkbox" id="imas1" name="imas[1]" value="true" <?php echo $selectImas[1] ?>>
    </div>
        <div class="pure-control-group">
      <label for="imas2">第２期<br>アイドルマスター</label>
      <input type="checkbox" id="imas2" name="imas[2]" value="true" <?php echo $selectImas[2] ?>>
    </div>
          <!-- 
        <div class="pure-control-group">
      <label for="imas3">第３期<br>アイドルマスター</label>
      <input type="checkbox" id="imas3" name="imas[3]" value="true" <?php echo $selectImas[3] ?>>
    </div>
        <div class="pure-control-group">
      <label for="imas4">第４期<br>アイドルマスター</label>
      <input type="checkbox" id="imas4" name="imas[4]" value="true" <?php echo $selectImas[4] ?>>
    </div>
        <div class="pure-control-group">
      <label for="imas5">第５期<br>アイドルマスター</label>
      <input type="checkbox" id="imas5" name="imas[5]" value="true" <?php echo $selectImas[5] ?>>
    </div>
        <div class="pure-control-group">
      <label for="imas6">第６期<br>アイドルマスター</label>
      <input type="checkbox" id="imas6" name="imas[6]" value="true" <?php echo $selectImas[6] ?>>
    </div>
        <div class="pure-control-group">
      <label for="imas7">第７期<br>アイドルマスター</label>
      <input type="checkbox" id="imas7" name="imas[7]" value="true" <?php echo $selectImas[7] ?>>
    </div>

  -->

</div> <!-- 折りたたみ -->

    <div class="pure-controls">
      <button type="submit" class="pure-button pure-button-primary">送信</button>
    </div>

    <?php include ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/include/ad.php"); ?>


      <table cellpadding="5" cellspacing="1" rules="cols">

        <tr class="heading_tr">
          <th class="heading">Title</th>
          <th class="heading">Debut</th>
          <th class="heading">Regular</th>
          <th class="heading">Pro</th>
          <th class="heading">Master</th>
        </tr>
        <tr>
          <td class="title heading_tr">難易度ごとに全てチェック</td>
          <td class="box_cell">
            <input class="checkAll music" id="Debut" type="checkbox">
          </td>
          <td class="box_cell">
            <input class="checkAll music" id="Regular" type="checkbox">
          </td>
          <td class="box_cell">
            <input class="checkAll music" id="Pro" type="checkbox">
          </td>
          <td class="box_cell">
            <input class="checkAll music" id="Master" type="checkbox">
          </td>
        </tr>

        <?php

//並び替え 並び替えると勝手に添字が振り直されるので 一旦keyをstringに変えたい
$newArr = array();
foreach ($arr as $key => $value){
    $sortKey[$key] = $value['order'];
    // keyに'_'を付与
    $newArr[$key . "_"] = $value;
}
$arr = $newArr;
array_multisort ( $sortKey , SORT_ASC, SORT_NUMERIC , $arr);
// intに戻す かなり冗長だけど取り急ぎ
$newArr = array();
foreach ($arr as $key => $value) {
    $newArr[str_replace('_', '', $key)] = $value;
}
$arr = $newArr;


foreach ($arr as $key => $value) {
      //idが少なかったら３桁0埋めする
    $key = sprintf('%03d', $key);
    
    $k = $key . "_1," . $key . "_2," . $key . "_3," . $key . "_4";
    $sql = "SELECT " . $k . " FROM  `fcmgt4slstage` WHERE  `id` = :id";
    $stmt=$pdo->prepare($sql);
    $res=$stmt->execute(array(":id" =>$getUserid));
    $query = $stmt->fetchAll()[0];
    
    $doCheck = array();
    for ($i=0; $i <= 3; $i++) {
        if ($query[$i] == 1) {
            $doCheck[$i] = "checked";
        }else{
            $doCheck[$i] = "";
        }
    }
    
    print<<<EOF
    
    <tr>
    <td class="title" id="bg{$key}">
    <div class="tableWrapper">{$value['name']}</div>
    </td>
    <td class="box_cell">
    <input class="Debut music" id="{$key}_1" name="arr[]" type="checkbox" value="{$key}_1" {$doCheck['0']}>
    </td>
    <td class="box_cell">
    <input class="Regular music" id="{$key}_2" name="arr[]" type="checkbox" value="{$key}_2" {$doCheck[1]}>
    </td>
    <td class="box_cell">
    <input class="Pro music" id="{$key}_3" name="arr[]" type="checkbox" value="{$key}_3" {$doCheck[2]}>
    </td>
    <td class="box_cell">
    <input class="Master music" id="{$key}_4" name="arr[]" type="checkbox" value="{$key}_4" {$doCheck[3]}>
    </td>
    </tr>
    
EOF;
    
}
?>
      </table>

      &nbsp;ページ上部のメニューにある免責事項、プライバシーポリシーをよくお読みになって同意いただける場合のみご使用ください。

      <div class="pure-controls">
        <button type="submit" class="pure-button pure-button-primary">送信</button>
      </div>
  </form>

  <?php
include ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/include/ad.php");

include_once ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/include/footer.php");