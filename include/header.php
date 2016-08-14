<?php
/* ページの頭に
include_once ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/include/header.php");

ページの最後に
include_once ($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/include/footer.php");

*/

print<<<EOF

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>FullCombo-management-tool-for-sl-stage</title>
	<link rel="stylesheet" href="style/reset.css">
	<link rel="stylesheet" href="style/base.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
	<script src='js/jquery.js'></script>
	<script src="/fcMgt4slStage/js/drawer.js"></script>
</head>
<body>

	<div id="wrapper">

		<header id="header" class="clearfix">
			<h1 class="logo">FullCombo-management-tool-for-sl-stage</h1>
			<div class="right">
				<p class="open"><i class="fa fa-bars"></i> MENU</p>
			</div>
		</header>

		<div id="contents">

EOF;


