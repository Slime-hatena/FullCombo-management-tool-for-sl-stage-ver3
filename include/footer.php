<?php
$y = date('Y');

print<<<EOF


</div>

<div class="footer">
<p>
Copyright © 2015 - {$y} Slime_hatena All Rights Reserved.</p>

<p>
©BANDAI NAMCO Entertainment Inc.<br>
©BNEI / PROJECT CINDERELLA</p>

<p>
権利者様からの申立て等は速やかに対応します。<br>
画像データをはじめとした著作物は著作者様に帰属します。</p>

</div>

</div>
</div>

</div>

<nav id="global">
    <div class="headline">{$Version}<br>
EOF;

if (isset($screen_name)){
    echo  'ログイン : @'.$screen_name;
}else{
    echo "未ログイン";
}

print<<<EOF
</div>
    <ul id="global-menu">
        <li><a href="index.php">トップページ</a></li>
		<li><a href="login.php">ログイン / ログアウト</a></li>
        <li><a href="addData.php">プロフィール登録/更新</a></li>
		<li><a href="user.php?my">マイページ</a></li>
        <li><a href="generate.php">画像生成(準備中)</a></li>
        <li><a href="search.php">検索(準備中)</a></li>
        <li><a href="AllUser.php">全ユーザー一覧</a></li>
        <li><a href="fcRate.php">参考フルコンボレート(準備中)</a></li>
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
