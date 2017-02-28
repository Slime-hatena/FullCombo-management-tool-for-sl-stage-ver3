<?php
// カードを生成する機能

include_once ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/include/header.php");

print<<<EOF

<form class="pure-form pure-form-aligned" action="makeImage.php" id="main" method="post" name="main" enctype="multipart/form-data">

   <p>
      <b>生成する難易度</b>
      <br> &ensp;
      <select name="difficulty">
        <option value="4">Master</option>
        <option value="3">Pro</option>
        <option value="2">Regular</option>
        <option value="1">Debut</option>
      </select>  を生成する。
    </p>

    <p><b>生成モード</b>
    <br> &ensp;<input type="radio" id="all" name="music_select" value="all" checked><label for="all">全楽曲を画像化</label>
    <br> &ensp;<input type="radio" id="none" name="music_select" value="none"><label for="none">未フルコン曲のみを画像化</label>
    </p>

          <div class="pure-controls">
        <button type="submit" class="pure-button pure-button-primary">送信</button>
      </div>
  </form>

EOF;

include_once ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/include/footer.php");