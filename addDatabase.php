<?php

require_once dirname ( __FILE__ ) . "/../../../undefined/DSN.php";

try {
	$pdo = new PDO ( 'mysql:host=' . $dsn ['host'] . ';dbname=' . $dsn ['dbname'] . ';charset=utf8', $dsn ['user'], $dsn ['pass'], array (
			PDO::ATTR_EMULATE_PREPARES => false
	) );
} catch ( PDOException $e ) {
	exit ( 'connection unsuccess' . $e->getMessage () );
}

$json_music = file_get_contents("../slStageMusicDatabase/music.json");
$json_music = mb_convert_encoding($json_music, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');

$arr = json_decode($json_music, true);

foreach ($arr as $key => $value) {

}