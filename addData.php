<?php
$json_music = file_get_contents("../slStageMusicDatabase/music.json");
$json_music = mb_convert_encoding($json_music, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');

$arr = json_decode($json_music, true);



?>

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
    <!--
<p>
<b>生成する難易度を選択してください</b>
<br> &ensp;
<select name="limit_1">
<option disabled>--Master--</option>
<option selected value="28">28</option>
<option value="27">27</option>
<option value="26">26</option>
<option value="25">25</option>
<option value="24">24</option>
<option value="23">23</option>
<option value="22">22</option>
<option value="21">21</option>
<option value="20">20</option>
<option disabled>--Pro--</option>
<option value="19">19</option>
<option value="18">18</option>
<option value="17">17</option>
<option value="16">16</option>
<option value="15">15</option>
<option disabled>--Regular--</option>
<option value="14">14</option>
<option value="13">13</option>
<option value="12">12</option>
<option value="11">11</option>
<option value="10">10</option>
<option disabled>--Debut--</option>
<option value="9">9</option>
<option value="8">8</option>
<option value="7">7</option>
<option value="6">6</option>
<option value="5">5</option>
</select> から
<select name="limit_2">
<option disabled>--Master--</option>
<option value="28">28</option>
<option value="27">27</option>
<option value="26">26</option>
<option value="25">25</option>
<option value="24">24</option>
<option value="23">23</option>
<option value="22">22</option>
<option value="21">21</option>
<option value="20">20</option>
<option disabled>--Pro--</option>
<option value="19">19</option>
<option value="18">18</option>
<option value="17">17</option>
<option value="16">16</option>
<option value="15">15</option>
<option disabled>--Regular--</option>
<option value="14">14</option>
<option value="13">13</option>
<option value="12">12</option>
<option value="11">11</option>
<option value="10">10</option>
<option disabled>--Debut--</option>
<option value="9">9</option>
<option value="8">8</option>
<option value="7">7</option>
<option value="6">6</option>
<option selected value="5">5</option>
</select> までを生成する。
<br> <span style="font-size: 80%;">上から４つ目以降の難易度は小さめに表示されます<br>
たくさん選ぶとはみ出るかもしれません(ごめんなさい、その場合は教えて下さい。)<br>
選択していない難易度でも総合評価には含まれます。(別々にしろという要望が多ければ対応するかもしれません)
</span>
</p>
<p>
集計方法：
<select name="limited_1">
<option value="All">全楽曲で生成する</option>
<option value="Limited">限定楽曲を除く</option>
<option value="Event">先行解禁曲を除く</option>
</select>
<br> "限定楽曲を除く"はススメオトメなどを含む限定タブにある曲全てを集計しません。
<br> 曜日違いで出てない曲の状況がわからない時に使ってください。
<br>
<br> "先行解禁曲を除く"はCDのシリアルコードやイベント達成での先行解禁曲を集計しません。
</span>
</p>

-->

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

  //todo jsonからロードして回す
    
    print<<<EOF

    
    
    <tr>
    <th class="index" id="bg01">
    <div class="wrapper">お願い!シンデレラ</div>
    </th>
    <td>
    <input class="Debut" id="01_1" name="arr[]" type="checkbox" value="05_0">
    </td>
    <td>
    <input class="Regular" id="01_2" name="arr[]" type="checkbox" value="10_0">
    </td>
    <td>
    <input class="Pro" id="01_3" name="arr[]" type="checkbox" value="15_0">
    </td>
    <td>
    <input class="Master" id="01_4" name="arr[]" type="checkbox" value="20_0">
    </td>
    </tr>
    
EOF;
    
    ?>

    </table>
    <br>
    <p>
      <b>生成後の処理を選択してください</b>
      <br>
      <label for="download">
        <input checked id="download" name="process" type="radio" value="download">画像をダウンロードする</label>
      <br>
      <?php
    // セッションに入れておいたさっきの配列
    if (isset ( $_SESSION ['access_token'] )) {
        $access_token = $_SESSION ['access_token'];
        // 取得できたらツイートを選択できるように
        echo "<label for=\"tweet\"><input type=\"radio\" name=\"process\" id=\"tweet\"
        value=\"tweet\" > ツイートする</label>";
    } else {
        
        echo "<span style=\"font-size: 80%;\">ツイートする場合はTwitterへのログインが必要です。</span>";
    }
    ?>
    </p>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js">
    </script>
    <!-- http://svr.aki-memo.net/FullCombo-management-tool-for-sl-stage/form.html -->
    <ins class="adsbygoogle" data-ad-client="ca-pub-5232158002747798" data-ad-format="auto" data-ad-slot="5731797260" style="display: block"></ins>
    <script>
      (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
    <br>
    <p>ページ上部のメニューにある免責事項、プライバシーポリシーをよくお読みになって同意いただける場合のみご使用ください。</p>
    <p style="font-size: 0.5rem;">
      <input class="btn" type="submit" value="送信する">
      <input class="btn" style="margin-left: 20px;" type="reset" value="リセット">
    </p>
  </form>
  <hr>
  <p style="font-size: 13px;">
    不具合報告やご意見などは<a href="https://twitter.com/Slime_hatena">Twitter</a>または<a href="https://github.com/Slime-hatena/FullCombo-management-tool-for-sl-stage/issues">Github
    Issues</a>にお気軽にどうぞ。
    <br> TwitterのDMはフォローしていなくても送れると思います。
  </p>
  <p style="font-size: 13px;">
    サーバーの維持費を少しでも軽減するため広告を設置させていただきました。ご理解の程よろしくおねがいします。</p>
  <p style="font-size: 9px;">
    現在は入力されたデータの収集はしていませんが、今後○○のフルコンレートは○○%みたいな機能を実装したいなとは思ってます。予定ですが。</p>
  <?php include("footer.html"); ?>
    </body>

    </html>