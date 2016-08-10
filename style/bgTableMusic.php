<?php
$json_music = file_get_contents("../../slStageMusicDatabase/music.json");
$json_music = mb_convert_encoding($json_music, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$arr = json_decode($json_music, true);

print<<<EOF

body {
	margin: 1;
	padding: 0;
    font-family: 'Hiragino Kaku Gothic Pro', 'ヒラギノ角ゴ Pro W3', 
	Meiryo, メイリオ, Osaka, 'MS PGothic', arial, helvetica, sans-serif;
	font-size: 0.85rem;
	line-height: 1.4;
}

table {
	border-collapse: collapse;
	border-style: solid; 
	border-color: #ffffff; 
	border-width: 1px; 
}

th {
	width: 220px;
	height: 30px;
	color: #000000;
	border-style: solid; 
	border-color: #ffffff; 
	border-width: 1px 0px;
}

td {
	color: #000000;
	border-style: solid; 
	border-color: #ffffff; 
	border-width: 1px 0px; 
	width: 40px;
	text-align: center;
	background: #ffffff;
}

*.heading {
	background: #f0f8ff;
	text-align: center;
	font-weight: bold;
}

*.index {
	/*
	background: #f0f8ff;
	*/
	text-align: center;
	font-weight: bold;
}

*.limited {
	/*
	background: #faf0ff;
	*/
	text-align: center;
	font-weight: bold;
}

.wrapper {
	background-color: rgba(255, 255, 255, 0.6);
}

.index, .limited {
	background-attachment: scroll !important;
	background-position: right center !important;
	background-repeat: no-repeat !important;
}

EOF;


foreach ($arr as $key => $value) {
print<<<EOF
#bg{$key} {
	background: url("../../slStageMusicDatabase{$value['thumbnail']}")}

EOF;
}
