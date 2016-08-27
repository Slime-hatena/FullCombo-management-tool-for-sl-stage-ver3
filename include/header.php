<?php
/* ページの頭に↓
include_once ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/include/header.php");

include_once ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/include/footer.php");
ページの最後に↑
*/

$Version = "ver.1608xx (3.0.0 Alpha)";

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
