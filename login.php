<?php 
print<<<EOF
<p>
    ログインにはTwitterを使用します。<br>
    ツイートする関係上権限がlevel2(書き込み)になりますが、ツイートとユーザーidの取得以外には使用しません。 <br>
    又、勝手にツイートすることもありません。
</p>
<p>
    セッションを保存できない状態だと正常に動きません。</p>

    <form method="post" action="twitter/login.php">
    <p>
    cookieを使用してログイン状態を保持する : <INPUT type="checkbox" name="useCookie" value="true">
</p>

<input type="image" src="img/twitter_parts/sign-in-with-twitter-gray.png" alt="送信する">
</form>
EOF;
