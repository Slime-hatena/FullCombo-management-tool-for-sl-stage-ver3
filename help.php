<?php

include_once ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/include/header.php");

print<<<EOF

<h2>はじめに</h2>
<p>
このツールにはバグが沢山あるはずです。<br>
挙動がおかしかったり、バグを見つけた場合は作者にお知らせください。</p>

<h2>ログイン</h2>
<p>
ログインページの Sign in with Twitter ボタンを押すとログインページに飛びます。<br>
チェックボックスにチェックを入れるとcookieを使用してログイン状態を保持します。有効期限は1年間です。<br>
但し、cookieを削除したりブラウザを変更するとログアウトされます。</p>
<p>ログイン状態はメニューバーの上部から確認できます</p>

<h2>データ登録</h2>
<p>
ログインしたらまずはデータ登録をしてください。<br>
非公開にしたいデータは空白で送信すると表示されません。</p>

<h2>共有の仕方</h2>
<p>マイページにアクセスし、一番下にある共有用URLを使用してください。</p>

<h2>参考フルコンレート</h2>
どれぐらいの人がこの曲をフルコンしている・・・ などを表示するツール(予定)です。<br>
只今準備中です。公開までお待ち下さい</p>


EOF;

include_once ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/include/footer.php");