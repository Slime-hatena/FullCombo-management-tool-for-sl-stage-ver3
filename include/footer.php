<?php
print<<<EOF

</div>

</div>

<nav id="global">
    <div class="headline">{$Version}</div>
    <ul id="global-menu">
        <li><a href="index.php">トップページ</a></li>
		<li><a href="login.php">ログイン / ログアウト</a></li>
		<li><a href="mypage.php">マイページ</a></li>
        <li><a href="addData.php">データ登録</a></li>
        <li><a href="fcRate.php">参考フルコンボレート</a></li>
        <li><a href="change.php">更新履歴</a></li>   
        <li><a href="policy.php">免責事項・プライバシーポリシー</a></li>
        <li><a href="license.php">ライセンス</a></li>
        <li><a href="help.php">使い方</a></li>

 
        <ul class="children">
            <li>
                <span class="trigger">Twitter</span>
                <ul class="target">
                    <li><a href="https://twitter.com/Slime_hatena" target="_blank">作者Twitter(@</i>Slime_hatena)</a></li>
                    <li><a href="https://twitter.com/fcMgt4slStage" target="_blank">お知らせ用Twitter (@fcMgt4slStage) </a></li>
                    <li><a href="https://twitter.com/imascg_stage" target="_blank">アイドルマスターシンデレラガールズ<br>スターライトステージ公式Twitter<br>(@imascg_stage) </a></li>
                </ul>
            </li>





            <div id="global-close">
                <p class="close"><i class="fa fa-times"></i> 閉じる</p>
            </div>
</nav>



EOF;
