<?php
require_once(__DIR__ . "/vendor/autoload.php");

/* ********************************************
 *                                            *
 * アプリ設定                                   *
 *                                            *
 ******************************************** */
/* タイムゾーンなど
********************************************* */
date_default_timezone_set('Asia/Tokyo');
const GLOBAL_APP_LANG = 'ja';
const GLOBAL_APP_ENCODE = 'UTF-8';
mb_language(GLOBAL_APP_LANG);
mb_internal_encoding(GLOBAL_APP_ENCODE);
/* Mastodon設定
********************************************* */
//インスタンス
const GLOBAL_INSTANCE = '';
//アカウント設定
const GLOBAL_CLIENT_KEY = ''; //クライアントキー
const GLOBAL_CLIENT_SECRET = ''; //クライアントシークレット
const GLOBAL_ACCESS_TOKEN = ''; //アクセストークン
/* コンテンツデータ
********************************************* */
//const CONTENTS_DATA = '[]';
const CONTENTS_DATA = '[{"ti":"Mastodon\u9023\u643a\u3082\u53ef\u80fd\u3067\u3059","co":"tootbot.php\u3092\u7528\u610f\u3059\u308b\u3053\u3068\u3067\u3001\r\nMastodon\u306b\u4e00\u5b9a\u6642\u9593\u304a\u304d\u306b\u30c8\u30a5\u30fc\u30c8\u3059\u308bbot\u306e\r\n\u30b3\u30f3\u30c6\u30f3\u30c4\u3092\u7ba1\u7406\u3059\u308b\u3053\u3068\u3082\u3067\u304d\u307e\u3059\u3002","ht":"Mastodon","im":"","wd":"\u66dc\u65e5\u6307\u5b9a","dw":"2,5","dy":"","dm":"","dd":"","tm":"16:17","kw":"Mastodon","la":"2018-09-29T16:18:08+09:00"},{"ti":"\u3044\u3061\u3054\u3093\u3055\u3093","co":"\u543e\u306f\u60aa\u4e8b\u3082\u4e00\u8a00\u3001\u5584\u4e8b\u3082\u4e00\u8a00\u3001\u8a00\u3044\u96e2\u3064\u795e","ht":"\u4e00\u8a00\u4e3b,\u795e\u8a71","im":"","wd":"\u65e5\u4ed8\u6307\u5b9a","dw":"","dy":"","dm":"","dd":"29","tm":"16:18","kw":"\u4e00\u8a00\u4e3b,\u795e\u8a71","la":"2018-09-29T16:17:35+09:00"},{"ti":"Hello KATSURAGI KAI","co":"KATSURAGI KAI\u3078\u3088\u3046\u3053\u305d\uff01","ht":"sample1","im":"","wd":"\u65e5\u4ed8\u6307\u5b9a\u3057\u306a\u3044","dw":"","dy":"","dm":"","dd":"","tm":"","kw":"sample1","la":"2018-09-29T14:56:27+09:00"}]';
/* パラメータ
********************************************* */
//トゥートの曜日or日付指定
const WEEK_DATE = array(
    "no" => "日付指定しない",
    "we" => "曜日指定",
    "dt" => "日付指定"
);
/* ********************************************
 *                                            *
 * エラーメッセージ                              *
 *                                            *
 ******************************************** */
//00 パラメータチェック
const ERR_MSG00 = 'err00: インスタンスが入力されていません';
const ERR_MSG01 = 'err01: クライアントキーが入力されていません';
const ERR_MSG02 = 'err02: クライアントシークレットが入力されていません';
const ERR_MSG03 = 'err03: アクセストークンが入力されていません';
//10 コンテンツ処理
const ERR_MSG10 = 'err10: トゥートするコンテンツがありません。';
const ERR_MSG11 = 'err11: トゥートするコンテンツがないか、データのフォーマットが正常ではありません。';
const ERR_MSG12 = 'err12: 条件にマッチするトゥートコンテンツが存在しませんでした。';
//20 Mastodon処理
const ERR_MSG20 = 'err20: トゥートを試みましたが、Mastodonインスタンスから応答がありませんでした。';
const ERR_MSG21 = 'err21: 画像IDが取得できません。';
const ERR_MSG22 = 'err22: 画像の送信が上手く行かなかったようです。';

/* ********************************************
 *                                            *
 * 汎用関数                                    *
 *                                            *
 ******************************************** */
/* エスケープ
********************************************* */
//HTML
function _h($str) {
    return htmlspecialchars($str, ENT_QUOTES, GLOBAL_APP_ENCODE);
}
//dollar
function _dl($str) {
    return str_replace('$', '\$', $str);
}
//quote
function _q($str) {
    return str_replace('\'', '\\\'', $str);
}
//スペース
function _s($str) {
    return str_replace(array(' ', "\t", "\s", "\r\n", "\r", "\n", "　"), '', $str);
}
/* 変換
********************************************* */
//JSON
function _je($arr) {
    return json_encode($arr, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
}
function _jd($str) {
    return json_decode($str);
}
//カンマ区切りを配列に
function _cm($str) {
    return explode(',', _s($str));
}
//配列の中身をハッシュタグ付きの文字列に
function _hashtags($array) {
    $resultStr = '';
    foreach($array as $index => $val) {
        $resultStr .= ' #' . $val;
    }
    return $resultStr;
}
/* エラー表示
********************************************* */
function errShow($errMsg) {
    foreach($errMsg as $err) {
        echo $err . "\n";
    }
    exit();
}
/* データ処理
********************************************* */


//Mastodonクラスをメディア付きトゥートできるように拡張
class mediaMastodon extends \theCodingCompany\Mastodon {
    //メンバ変数
    protected $accessToken;
    //コンストラクタ
    public function __construct($accessToken) {
        $this->accessToken = $accessToken;
    }
    //メディア送信メソッド
    public function PostMedia($imgPath = null) {
        if($imgPath){
            //mime_type
            $mimeType = $this->mimeTypeExtension($imgPath);
            //CurlFile PHP5.5～
            $cfile = curl_file_create($imgPath, $mimeType, 'file');
            //Posturl
            $url = $this->getApiURL() . "/api/v1/media";
            $headers = array(
                "Content-Type" => "multipart/form-data"
            );
            $postField = array(
                'access_token'  => $this->accessToken,
                'file'  => $cfile
            );
            //Curlの設定
            $options = array(
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_HTTPHEADER => $headers,
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $postField,
            );
            $curlHandle = curl_init();
            curl_setopt_array($curlHandle, $options);
            $response = curl_exec($curlHandle);
            curl_close($curlHandle);
            $response = json_decode($response, true);
            return $response;
        }
    }
    //メディア付きトゥートメソッド
    public function postStatuses($text = "", $mediaId = "", $visibility = "public") {
        if(!empty($this->accessToken)) {
            $headers = $this->getHeaders();
            $http = \theCodingCompany\HttpRequest::Instance($this->getApiURL());
            if(empty($mediaId)) { //メディアなし
                $status = $http::Post(
                    "api/v1/statuses",
                    array(
                        "status"        => $text,
                        "visibility"    => $visibility
                    ),
                    $headers
                );
            }
            else {
                $status = $http::Post(
                    "api/v1/statuses",
                    array(
                        "status"        => $text,
                        "visibility"    => $visibility,
                        "media_ids"     => array($mediaId)
                    ),
                    $headers
                );
            }
            return $status;
        }
        return false;
    }
    //mime type設定
    public function mimeTypeExtension($imgPath = null) {
        if($imgPath){
            $size = @getimagesize($imgPath);
            switch($size['mime']){
                //jpeg
                case IMAGETYPE_JPEG:
                    return "image/jpg";
                    break;
                //png
                case IMAGETYPE_PNG:
                    return "image/png";
                    break;
                //gif
                case IMAGETYPE_GIF:
                    return "image/gif";
                    break;
            }
        }
        return '';
    }
}

$errMsg = [];
if(empty(GLOBAL_INSTANCE)) {
    $errMsg[] = ERR_MSG00;
}
if(empty(GLOBAL_CLIENT_KEY)) {
    $errMsg[] = ERR_MSG01;
}
if(empty(GLOBAL_CLIENT_SECRET)) {
    $errMsg[] = ERR_MSG02;
}
if(empty(GLOBAL_ACCESS_TOKEN)) {
    $errMsg[] = ERR_MSG03;
}
if(empty(CONTENTS_DATA)) {
    $errMsg[] = ERR_MSG10;
}
if(count($errMsg) > 0) { //エラーがある場合
    errShow($errMsg);
}
//エラーがなければ処理続行
//設定
$t = new mediaMastodon(_h(GLOBAL_ACCESS_TOKEN)); //コンストラクタでtoken_accessを受け付け、メディア送信に備える
$t->setMastodonDomain(_h(GLOBAL_INSTANCE)); //設定したインスタンスを入力
$t->setCredentials([
    "client_id" => _h(GLOBAL_CLIENT_KEY),
    "client_secret" => _h(GLOBAL_CLIENT_SECRET),
    "bearer" => _h(GLOBAL_ACCESS_TOKEN) //上と重複しているが、通常のテキストトゥートの認可のためにもう一度access_token記述
]);
//データ整形
$array = _jd(CONTENTS_DATA);
//データ用の変数用意
$dateArray = [];
$nonDateArray = [];
$hitDateArray = [];
$tootData;
//配列としてデータがあるか
if(count($array) <= 0) {
    $errMsg[] = ERR_MSG11;
}
if(count($errMsg) > 0) { //エラーがある場合
    errShow($errMsg);
}
//日時指定データと指定なしデータに分割
foreach($array as $val) {
    if($val->wd === WEEK_DATE['we'] || $val->wd === WEEK_DATE['dt']) {
        $dateArray[] = $val;
    }
    else {
        $nonDateArray[] = $val;
    }
}
//日時指定データがある場合はその前後5分(Linux TimeStampで±300秒)の範囲にあるかチェック
if(count($dateArray) > 0) {
    $nowTime = date('U');
    $nowYear = date('Y');
    $nowMonth = date('m');
    $nowDay = date('d');
    $todayWeek = date('w');
    $assignTime = 0;
    foreach($dateArray as $val) {
        $dateStr = '';
        //曜日は今日の曜日と比較
        if($val->wd === WEEK_DATE['we']) {
            foreach(_cm($val->dw) as $week) {
                if($todayWeek === $week) { //曜日が合致すれば今日の日付とする
                    $dateStr = date('Y-m-d');
                    break;
                }
            }
        }
        //日付指定がある場合は年月日で比較
        else if($val->wd === WEEK_DATE['dt']) {
            //年月日あればそのまま
            if(!empty($val->dy) && !empty($val->dm) && !empty($val->dd)) {
                if((int)$val->dy === (int)$nowYear && (int)$val->dm === (int)$nowMonth && (int)$val->dd === (int)$nowDay) { //合致すれば今日の年月日を日付とする
                    $dateStr = date($val->dy . '-' . $val->dm . '-' . $val->dd);
                }
            }
            //月日のみは双方比較
            else if(!empty($val->dm) && !empty($val->dd)) {
                if((int)$val->dm === (int)$nowMonth && (int)$val->dd === (int)$nowDay) { //合致すれば今日の年月日を日付とする
                    $dateStr = date($nowYear . '-' . $val->dm . '-' . $val->dd);
                }
            }
            //日のみは日のみ比較
            else if(!empty($val->dd)) {
                if((int)$val->dd === (int)$nowDay) { //合致すれば今日の年月日を日付とする
                    $dateStr = date($nowYear . '-' . $nowMonth . '-' . $val->dd);
                }
            }
        }
        if(!empty($dateStr)) { //日付指定条件クリアした場合のみ
            $assignTime = date('U', strtotime($dateStr . ' ' . $val->tm . ':00'));
            if($nowTime - 300 <= $assignTime && $assignTime < $nowTime + 300) {
                $hitDateArray[] = $val;
            }
        }
    }
}
//条件にヒットしたデータが複数ある場合も考慮して、配列の中からランダムで1つ抽出
if(count($hitDateArray) > 0) {
    $tootData = $hitDateArray[array_rand($hitDateArray)];
}
//日付指定データがない、もしくは該当する日時がなかった場合は、日時指定がないデータの中からランダムで1つを抽出
else {
    if(count($nonDateArray) > 0) {
        $tootData = $nonDateArray[array_rand($nonDateArray)];
    }
    else {
        $tootData = [];
    }
}
//トゥートデータがない場合
if(count($tootData) <= 0) {
    $errMsg[] = ERR_MSG12;
}
if(count($errMsg) > 0) { //エラーがある場合
    errShow($errMsg);
}
//トゥートテキスト用意
$tootText = '';
//トゥートするテキストとハッシュタグを連結
if(!empty($tootData->ht)) {
    $tootText = _h($tootData->co) . _hashtags(_cm(_h($tootData->ht)));
}
else {
    $tootText = _h($tootData->co);
}
//画像パス用意
$imgPath = _q(_h($tootData->im));
if(!empty($imgPath)) { //画像の指定がある場合、画像をアップロードし、そのレスポンスの画像のIDでメディア付きトゥートを行う
    $response = $t->PostMedia($imgPath); //画像をサーバに送信、レスポンスのjsonを取得
    if(count($response) > 0) {
        if(!empty($response['id'])) {
            $statuses = $t->postStatuses($tootText, $response['id']); //レスポンス中に含まれている画像のidをパラメータに含めた形でトゥート
            if(empty($statuses)) {
                $errMsg[] = ERR_MSG20;
            }
        }
        else {
            $errMsg[] = ERR_MSG21;
        }
    }
    else {
        $errMsg[] = ERR_MSG22;
    }
}
else {
    $status = $t->postStatus($tootText); //トゥート
    if(empty($status)) {
        $errMsg[] = ERR_MSG20;
    }
}
if(count($errMsg) > 0) { //エラーがある場合
    errShow($errMsg);
}