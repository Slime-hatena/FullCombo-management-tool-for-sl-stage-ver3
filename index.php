<?php

include_once ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/include/header.php");

print<<<EOF

<h2>このサイトについて</h2>
<p>
Cygamesが運営中のゲーム、アイドルマスターシンデレラガールズスターライトステージのフルコン状況を共有できるツールです。<br> 
他人のデータを閲覧することもできます<br></p>

<p>
ログインにはTwitterを使用します。閲覧のみならログインは必要ありません。<br>
メニューから免責事項・プライバシーポリシーを一読してからご利用ください。<br>
初めての方はまず使い方を読むことをおすすめします。
</p>

<p>当サイトはファンサイトであり権利者様とは一切関係がありません。<br>
お問い合わせ等は作者のTwitterへお願いします。(フォローしていなくてもDMが送信できます)</p>

<h2>簡単な使い方</h2>
<p>まずは右上のメニューボタンを押してログインしてみてください！<br>
ログインが終わったらメニューからデータ登録ができます。<br>
データ登録が終わるとマイページの最下部に共有用のURLとツイートボタンが出てきます。<br>
そのURLからフルコン状況を共有できます！</p>

<h2>サンプル</h2>
<a href="http://svr.aki-memo.net/fcMgt4slStage/user.php?s=0">作者のフルコン状況</a>
EOF;

include_once ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/include/footer.php");