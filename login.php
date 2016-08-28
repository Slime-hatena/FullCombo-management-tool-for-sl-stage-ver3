<?php 

include_once ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/include/header.php");

print<<<EOF
<h2>ログインページ</h2>
<p>
    ログインにはTwitterを使用します。<br>
    ツイートする関係上権限がlevel2(書き込み)になりますが、勝手にツイートすることはありません。
</p>
<p>
    セッションを保存できない状態だと正常に動きません。<br>
    cookieを使用してログイン状態を保存できます。共用PCなどでは十分注意して使用してください。</p>

    <form method="post" action="twitter/login.php">
    <p>
    <label for="cb">cookieを使用してログイン状態を保持する : </label><input type="checkbox" id="cb" name="useCookie" value="true">
</p>

<input type="image" src="img/twitter_parts/sign-in-with-twitter-gray.png" alt="ログイン">
</form>

<p><span style="font-size:1.2rem"><a href="twitter/logout.php">ログアウトはこちら</a></span></p>
EOF;

include_once ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/include/footer.php");
