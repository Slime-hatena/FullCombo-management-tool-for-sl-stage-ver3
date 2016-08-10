<?php

require_once dirname ( __FILE__ ) . "/../../../undefined/fcMgt4slStage.php";

// 「連携アプリを認証」をクリックして帰ってきた時
if( isset( $_GET['oauth_token'] ) && !empty( $_GET['oauth_token'] ) && isset( $_GET['oauth_verifier'] ) && !empty( $_GET['oauth_verifier'] ) )
{

	$isSuccess = true;

//[リクエストトークン・シークレット]をセッションから呼び出す
session_start() ;
$request_token_secret = $_SESSION['oauth_token_secret'] ;

// リクエストURL
$request_url = 'https://api.twitter.com/oauth/access_token' ;

// リクエストメソッド
$request_method = 'POST' ;

// キーを作成する
$signature_key = rawurlencode( $consumer_secret ) . '&' . rawurlencode( $request_token_secret ) ;

// パラメータ([oauth_signature]を除く)を連想配列で指定
$params = array(
	'oauth_consumer_key' => $consumer_key ,
	'oauth_token' => $_GET['oauth_token'] ,
	'oauth_signature_method' => 'HMAC-SHA1' ,
	'oauth_timestamp' => time() ,
	'oauth_verifier' => $_GET['oauth_verifier'] ,
	'oauth_nonce' => microtime() ,
	'oauth_version' => '1.0' ,
) ;

// 配列の各パラメータの値をURLエンコード
foreach( $params as $key => $value )
{
	$params[ $key ] = rawurlencode( $value ) ;
}

// 連想配列をアルファベット順に並び替え
ksort($params) ;

// パラメータの連想配列を[キー=値&キー=値...]の文字列に変換
$request_params = http_build_query( $params , '' , '&' ) ;

// 変換した文字列をURLエンコードする
$request_params = rawurlencode($request_params) ;

// リクエストメソッドをURLエンコードする
$encoded_request_method = rawurlencode( $request_method ) ;

// リクエストURLをURLエンコードする
$encoded_request_url = rawurlencode( $request_url ) ;

// リクエストメソッド、リクエストURL、パラメータを[&]で繋ぐ
$signature_data = $encoded_request_method . '&' . $encoded_request_url . '&' . $request_params ;


// キー[$signature_key]とデータ[$signature_data]を利用して、HMAC-SHA1方式のハッシュ値に変換する
$hash = hash_hmac( 'sha1' , $signature_data , $signature_key , TRUE ) ;

// base64エンコードして、署名[$signature]が完成する
$signature = base64_encode( $hash ) ;

// パラメータの連想配列、[$params]に、作成した署名を加える
$params['oauth_signature'] = $signature ;

// パラメータの連想配列を[キー=値,キー=値,...]の文字列に変換する
$header_params = http_build_query( $params , '' , ',' ) ;

// リクエスト用のコンテキストを作成する
$context = array(
	'http' => array(
		'method' => $request_method , //リクエストメソッド
		'header' => array(			  //カスタムヘッダー
			'Authorization: OAuth ' . $header_params ,
		) ,
	) ,
) ;

// cURLを使ってリクエスト
$curl = curl_init() ;
curl_setopt( $curl , CURLOPT_URL , $request_url ) ;
curl_setopt( $curl , CURLOPT_HEADER, 1 ) ; 
curl_setopt( $curl , CURLOPT_CUSTOMREQUEST , $context['http']['method'] ) ;			// メソッド
curl_setopt( $curl , CURLOPT_SSL_VERIFYPEER , false ) ;								// 証明書の検証を行わない
curl_setopt( $curl , CURLOPT_RETURNTRANSFER , true ) ;								// curl_execの結果を文字列で返す
curl_setopt( $curl , CURLOPT_HTTPHEADER , $context['http']['header'] ) ;			// ヘッダー
curl_setopt( $curl , CURLOPT_TIMEOUT , 5 ) ;										// タイムアウトの秒数
$res1 = curl_exec( $curl ) ;
$res2 = curl_getinfo( $curl ) ;
curl_close( $curl ) ;

// 取得したデータ
$response = substr( $res1, $res2['header_size'] ) ;				// 取得したデータ(JSONなど)
$header = substr( $res1, 0, $res2['header_size'] ) ;		// レスポンスヘッダー (検証に利用したい場合にどうぞ)

// 文字列を[&]で区切る
$parameters = explode( "&" , $response ) ;

// HTMLの変数
$html = "" ;

// それぞれの値を格納する配列
$query = array() ;

// [$parameters]をループ処理
foreach( $parameters as $parameter )
{
	// 文字列を[=]で区切る
	$pair = explode( "=" , $parameter ) ;

	// 配列に格納する
	$query[ $pair[0] ] = $pair[1] ;
    /*
    oauth_token
    oauth_token_secret
    user_id
    screen_name
    */



}

print_r($query);


}

// 「キャンセル」をクリックして帰ってきた時
elseif( isset( $_GET['denied'] ) && !empty( $_GET['denied'] ) )
{
	$isSuccess = false;
	// エラーメッセージを出力して終了
	echo '認証に失敗しました : Twitter連携を許可しなかったようです。<br><a href="http://yahoo.co.jp">bye...</a>' ;

}

//ログに保存する処理
$logWrite ="Success : " . $isSuccess . "
response : " . $response . "
header : " . $header . "
oauth_token : " . $query['oauth_token'] . "
oauth_token_secret : " . $query['oauth_token_secret'] . "
user_id : " . $query['user_id'] . "
screen_name : " . $query['screen_name'] . "
";
include($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/log/logWriter.php");
