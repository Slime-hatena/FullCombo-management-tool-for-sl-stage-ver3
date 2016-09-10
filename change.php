<?php

include_once ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/include/header.php");

print<<<EOF

<h2>更新履歴</h2>
<p>下に行くほど古い内容です。<br> 
ソース的な更新履歴は<a href="https://github.com/Slime-hatena/FullCombo-management-tool-for-sl-stage-ver3" target="_blank">github</a>にてどうぞ。</p>

<h3>ver.160911 (3.0.1)</h3>
<p><s>リリースしてあるのにα版ってなんだよと思ったので</s><br>
バージョンからAlphaが取れました。特に意味は無いです。</p>
<p>
<a href="AllUser.php">全ユーザー一覧</a>を作ってみました。<br>プロフィール登録をしたことがない方は表示されないようになってます。</p><p>
BEYOND THE STARLIGHTを追加しました。<br>追加後にプロフィールを更新しないと該当楽曲が灰色になるので、好きなタイミングで更新してください。</p><p>
「データ登録」を「プロフィール登録/更新」に変更しました。<br>こっちのほうがきっとわかりやすいよね！</p>
<p>アップデート内容はこんな感じです。<br>
私事ですが編成を見直したらスコアが90000づつぐらい上がりました。<br>
スコアアップとオーバーロードは同時発動すると重なるんですかね？<br>
当面の目標はPRP1000ということでよろしくお願いします。</p>

</p>


<h3>ver.160830 (3.0.0 Alpha)</h3>
<p>3回目の初公開<br>
デバッグが不十分かもしれないけどリリースしました。<br>
今後とも宜しくお願いします。</p>

EOF;

include_once ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/include/footer.php");