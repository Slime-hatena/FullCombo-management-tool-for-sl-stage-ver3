<?php
/* ページの頭に↓
include_once ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/include/header.php");

include_once ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/include/footer.php");
ページの最後に↑

user.phpのみ使用していない。

*/

$Version = "ver.161111 (3.0.3)";
$adViewCount = 0;

//ログイン情報を取る
require_once ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/twitter/twitterLoader.php");



print<<<EOF

<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>FullComboManagementTool for sl-stage</title>
    
<link rel="stylesheet" href="style/reset.css">

<link rel="stylesheet" href="style/pure-min.css">
<link rel="stylesheet" href="lib/animatedtablesorter/style.css" type="text/css" />


<link rel="stylesheet" href="style/base.css">

<link rel="stylesheet" type="text/css" href="style/bgTableMusic.css">
<link rel="stylesheet" type="text/css" href="style/check.css">
<link rel="stylesheet" type="text/css" href="style/userPage.css">
<link rel="stylesheet" type="text/css" href="style/table.css">
<link rel="stylesheet" type="text/css" href="style/bg.css">

<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">

<script src='js/jquery.js'></script>
<script src="js/drawer.js"></script>
<script type="text/javascript" src="js/checkAll.js"></script>
<script src="lib/animatedtablesorter/tsort.js"></script>
<script src="lib/animatedtablesorter/setting.js"></script>

<!-- favicon -->
<link rel="shortcut icon" href="img/icon/favicon.ico">
<!-- iOS Safari -->
<link rel="apple-touch-icon" sizes="120x120"
	href="img/icon/apple-touch-icon.png">
<!-- iOS Safari(旧) / Android標準ブラウザ(一部) -->
<link rel="apple-touch-icon-precomposed"
	href="img/icon/apple-touch-icon.png">
<!-- Android標準ブラウザ(一部) -->
<link rel="shortcut icon" href="img/icon/apple-touch-icon.png">
<!-- Android Chrome -->
<link rel="icon" sizes="120x120" href="img/icon/apple-touch-icon.png">


<meta name="twitter:card" content="summary" />
<meta name="twitter:site" content="@fcMgt4slStage" />
<meta name="twitter:image" content="http://svr.aki-memo.net/fcMgt4slStage/img/icon/apple-touch-icon.png" />

EOF;
// twitterCard
 if(strstr($_SERVER['REQUEST_URI'],'?',true) == "/fcMgt4slStage/user.php"){
	 // ユーザーページ
	 echo '<meta name="twitter:title" content="' . $name . 'さんのページ" />
<meta name="twitter:description" content="フルコン楽曲数: ' .  $a_all  . "/" .  $musicAll * 4 . ' 達成率: ' . sprintf('%0.2f', $a_all / ($musicAll * 4) * 100) . '%" />';
 }else{
	 echo '<meta name="twitter:title" content="FullComboManagementTool for sl-stage" />
<meta name="twitter:description" content="デレステのフルコン状況を共有できるツールです。他の人のデータを閲覧することもできます。" />';
 }



include_once ("include/analytics.php");

print<<<EOF


</head>

<body>


<div class="layerImage">
<div class="layerTransparent">

<div class="layerImage">
<div class="layerTransparent">
<div class="frontContents">
<div id="wrapper">

<header id="header" class="clearfix">
<h1 class="logo"><span class="br">FullComboManagementTool </span>
<wbr><span class="br">for sl-stage</span></h1>
    <div class="right">
<p class="open"><i class="fa fa-bars"></i></p>
</div>
</header>

<div id="contents">
EOF;
