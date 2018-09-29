<?php
/* ********************************************
KATSURAGI

Copyright 2018 Arm=Band

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
********************************************* */
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

/* ********************************************
 *                                            *
 * エラーメッセージ                              *
 *                                            *
 ******************************************** */
//00 ファイル操作
const ERR_MSG02 = 'err02: ファイル書き込みエラー';
//50 コンテンツ処理
const ERR_MSG50 = 'err50: 編集したい記事が指定されていません。';
const ERR_MSG51 = 'err51: 指定した記事が見付かりませんでした。';
const ERR_MSG52 = 'err52: 削除したい記事が指定されていません。';
//60 ログイン処理
const ERR_MSG60 = 'err60: ログインに失敗しました。';
const ERR_MSG61 = 'err61: ユーザIDまたはパスワードが間違っています。';
//70 インストール
const ERR_MSG70 = 'err70: インストールに失敗しました。ファイルをアップロードし直し、最初からやり直してください。';
//80 入力項目チェック
const ERR_MSG80 = 'err80: 必須項目が入力されていません。';
const ERR_MSG81 = 'err81: 半角英数字以外の文字が入力されているか、文字数が3文字未満か、101文字以上になっています。';
const ERR_MSG82 = 'err82: 半角英数字と記号の中から組み合わせてください。また、文字数は8文字以上100文字以下にしてください。';
const ERR_MSG83 = 'err83: 入力したパスワードが現在のパスワードと一致しません。';
const ERR_MSG85 = 'err85: 曜日が指定されていません。';
const ERR_MSG86 = 'err86: 日付の入力が不正です。';
//90 汎用
const ERR_MSG99 = 'err99: 予期しないページからのリクエストです。異なるドメインからの入力の可能性があります。';

/* ********************************************
 *                                            *
 * 定数                                        *
 *                                            *
 ******************************************** */
/* アプリ設定
********************************************* */
//コピーライト
const GLOBAL_APP_AUHTOR = 'アルム＝バンド'; //著者
const GLOBAL_APP_AUHTOR_URL = 'https://lab.ewigleere.net'; //著者サイトのURL
const GLOBAL_APP_COPYRIGHT_YEAR = '2018'; //コピーライト表示の年
const GLOBAL_APP_NAME = 'KATSURAGI KAI'; //アプリ名
const GLOBAL_APP_URL = 'https://lab.ewigleere.net'; //KATSURAGIのURL
const GLOBAL_APP_VERSION = '0.2.0'; //KATSURAGIのバージョン
/* モード設定
********************************************* */
//ログイン
const MODE_LOGIN = 1;
const MODE_UNLOGIN = 0;
//インストール(未インストール: 0, インストール済: 1)
const MODE_INSTALLED = 0;
//操作完了画面のモード
const SHOW_MODE = array(
    "co" => "contents",
    "st" => "settings",
    "lo" => "logout",
    "is" => "installed"
);
//Mastodon連携ファイル
const TOOT_FILE = 'tootbot.php';
//連携できるか、ファイル書き込み権限があるかで判定(t or f)
const MASTODON_FILE = __DIR__ . DIRECTORY_SEPARATOR . TOOT_FILE;
define('TOOT_MODE', is_writable(MASTODON_FILE));
//トゥートの曜日or日付指定
const WEEK_DATE = array(
    "no" => "日付指定しない",
    "we" => "曜日指定",
    "dt" => "日付指定"
);
//曜日
const WEEK = array(
    "日", "月", "火", "水", "木", "金", "土"
);
/* ********************************************
 *                                            *
 * 変数                                        *
 *                                            *
 ******************************************** */
//エラーフラグ
$errFlg = 0;
$errMsg = [];

/* ********************************************
 *                                            *
 * データフィールド                              *
 *                                            *
 ******************************************** */
/* グローバル設定
********************************************* */
const GLOBAL_SITENAME = 'KATSURAGI'; //サイト名
const GLOBAL_DESCRIPTION = 'It\'s very the simple cms that\'s consist of one file and powered by PHP.'; //説明
const GLOBAL_THEME_COLOR = '#98B948'; //メインカラー
const GLOBAL_AUHTOR = 'admin'; //著者
const GLOBAL_AUHTOR_URL = './'; //著者サイトのURL
const GLOBAL_COPYRIGHT_YEAR = '2018'; //コピーライト表示の年
/* アカウント設定
********************************************* */
const GLOBAL_USER_ID = 'admin';
const GLOBAL_USER_PS = '$2y$10$gUvQWPnunTsGy8R/YApvdeAVv9L1RdIzqLh3VsB.UWXviWk/0GuYm';
/* OGP
********************************************* */
const GLOBAL_OGP_TWITTER_ACCOUNT = ''; //OGP用Twitterアカウント
const GLOBAL_OGP_IMAGE = ''; //OGP画像
define('GLOBAL_OGP_URL', (empty($_SERVER['HTTPS']) ? "http://" : "https://") . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME']); //URL //式はconstでは書けないのでdefineで定義
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

/* ********************************************
 *                                            *
 * ログイン                                    *
 *                                            *
 ******************************************** */
/* セッション
********************************************* */
function requireUnloginedSession() {
    // セッション開始
    @session_start();
    // ログインしていればフラグ立てる
    if(isset($_SESSION['userid'])) {
        return MODE_LOGIN;
    }
    else {
        return MODE_UNLOGIN;
    }
}
function requireLoginedSession() {
    // セッション開始
    @session_start();
    // ログインしていなければフラグ降ろす
    if(!isset($_SESSION['userid'])) {
        return MODE_UNLOGIN;
    }
    else {
        return MODE_LOGIN;
    }
}
/* トークン
********************************************* */
function generateToken() {
    // セッションIDからハッシュを生成
    return hash('sha256', session_id());
}
function validateToken($token) {
    // 送信されてきた$tokenがこちらで生成したハッシュと一致するか検証
    return $token === generateToken();
}

/* セッション
********************************************* */
$modeLogin = 0;
$modeLogin = requireUnloginedSession();

/* デバッグ
********************************************* */
//デバッグモード
const DEBUG_MODE = false;
//デバッグモードオンならばエラーメッセージ表示
function showErrMsg($e) {
    if(DEBUG_MODE) {
        echo $e->getMessage() . "\n";
    }
}

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
//改行をbrタグに
function _br($contentStr) {
    return preg_replace('(\r\n|\r|\n)', '<br>$1', $contentStr);
}
//カンマ区切りを配列に
function _cm($str) {
    return explode(',', _s($str));
}
//配列をカンマ区切りに
function _ca($array) {
    return implode(',', $array);
}
//配列の中身をハッシュタグ付きの文字列に
function _hashtags($array) {
    $resultStr = '';
    foreach($array as $index => $val) {
        $resultStr .= ' #' . $val;
    }
    return $resultStr;
}
/* 年表示に関する処理を行う
********************************************* */
//現在の年を出力（コピーライト用）
function copyrightYears($variables) {
    $year = (string)date('Y');
    if($year === $variables) {
        return $year;
    }
    else {
        return $variables . '-' . $year;
    }
}
//日付をUTCから指定方式の文字列に変換する(最終更新日付用)
function dateConvert($dateStr) {
    return date("Y/m/d H:i:s", strtotime($dateStr));
}
//日付を'yyyy-mm-dd', 'hh:ii'形式から'yyyy/mm/dd hh:ii:ss'に表示を変更する(投稿日時用)
function dateConvertPost($dateWeekDate, $dateWeek, $dateYearStr, $dateMonthStr, $dateDayStr, $timeStr) {
    if(!empty($timeStr)) {
        $yearStr = '----';
        $monthStr = '--';
        $dayStr = '--';
        $dateWeekStr = '';
        if(WEEK_DATE['we'] === $dateWeekDate) {
            if(!empty($dateWeek)) {
                foreach(_cm($dateWeek) as $key) {
                    $dateWeekStr .= ' ' . WEEK[(int)$key];
                }
                return $dateWeekStr . ' ' . $timeStr . ':00';
            }
            else {
                return '';
            }
        }
        else if(WEEK_DATE['dt'] === $dateWeekDate) {
            if(!empty($dateYearStr)) {
                $yearStr = $dateYearStr;
            }
            if(!empty($dateMonthStr)) {
                $monthStr = $dateMonthStr;
            }
            if(!empty($dateDayStr)) {
                $dayStr = $dateDayStr;
            }
            return $yearStr . '/' . $monthStr . '/' . $dayStr . ' ' . $timeStr . ':00';
        }
        else {
            return '';
        }
    }
    else {
        return '';
    }
}
/* コンテンツ内容を連想配列にする
********************************************* */
function contentsCreate($title, $contents, $hashtags, $imgPath, $dateWeekDate, $dateWeekStr, $dateYear, $dateMonth, $dateDay, $time, $keywords, $lastDate) {
    $content = array(
        'ti' => _h(_q($title)),
        'co' => _h(_q($contents)),
        'ht' => _h(_q($hashtags)),
        'im' => _h(_q($imgPath)),
        'wd' => _h(_q($dateWeekDate)),
        'dw' => _h($dateWeekStr),
        'dy' => _h(_q($dateYear)),
        'dm' => _h(_q($dateMonth)),
        'dd' => _h(_q($dateDay)),
        'tm' => _h(_q($time)),
        'kw' => _h(_q($keywords)),
        'la' => _h(_q($lastDate))
    );
    return $content;
}
/* コンテンツ内容を最終更新日付降順でソート
********************************************* */
function sortLastActivityDate($contentsArray) {
    //最終更新日のみ抽出
    foreach ((array) $contentsArray as $key => $value) {
        $value = (array)$value;
        $contentsArray[$key] = $value;
        $sort[$key] = $value['la'];
    }
    //最終更新日降順でソート
    array_multisort($sort, SORT_DESC, $contentsArray);
    return $contentsArray;
}

/* ********************************************
 *                                            *
 * チェック                                    *
 *                                            *
 ******************************************** */
function emptyCheck($str) {
    return empty($str);
}
function lentgthCheck($str, $len) {
    if(mb_strlen($str, GLOBAL_APP_ENCODE) >= $len) {
        return true;
    }
    return false;
}

/* ********************************************
 *                                            *
 * 表示                                        *
 *                                            *
 ******************************************** */
/* コンテンツ更新時・設定完了時の表示
********************************************* */
function dashboardFinished($mode) {
    //パラメータ
    $showMode = _h($mode);
    $finishedLang = _h(GLOBAL_APP_LANG);
    $finishedEncode = _h(GLOBAL_APP_ENCODE);
    $finishedSiteName = _h(GLOBAL_SITENAME);
    $finishedThemeColor = _h(GLOBAL_THEME_COLOR);
    //トークン
    $token = _h(generateToken());
    //表示文字
    $title = '';
    $heading = '';
    $headingIcon = '';
    $contents = '';
    $buttonIcon = '';
    if($mode === SHOW_MODE['co']) {
        $title = 'コンテンツ更新完了';
        $heading = 'Updated!';
        $headingIcon = 'file-signature';
        $contents = 'コンテンツの更新が完了しました。引き続き作業するには「ダッシュボードへ戻る」ボタンをクリックしてください。';
        $button = 'ダッシュボードへ戻る';
        $buttonIcon = 'undo';
    }
    else if($mode === SHOW_MODE['st']) {
        $title = '設定変更完了';
        $heading = 'Settings Finished!';
        $headingIcon = 'cogs';
        $contents = '設定変更が完了しました。引き続き作業するには「ダッシュボードへ戻る」ボタンをクリックしてください。';
        $button = 'ダッシュボードへ戻る';
        $buttonIcon = 'undo';
    }
    header('Content-Type: text/html; charset=UTF-8');
    echo <<< EOF
<!DOCTYPE html>
<html lang="{$finishedLang}">
<head>
    <meta charset="{$finishedEncode}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no,address=no,email=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$title} | {$finishedSiteName}</title>
    <!-- theme color -->
    <meta name="theme-color" content="{$finishedThemeColor}">
    <!-- css -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body class="{$showMode}" id="{$showMode}">
    <div id="wrapper">
        <!-- main -->
        <main class="main">
            <div class="container-fluid mb-4">
                <div class="pb-2 mt-4 mb-2 border-bottom">
                    <h2><i class="fas fa-fw fa-{$headingIcon}" aria-hidden="true"></i>{$heading}</h2>
                </div>
                <p>{$contents}</p>
            </div>
            <div class="container-fluid">
                <form action="./" method="get">
                    <input type="hidden" name="token" value="{$token}">
                    <input type="hidden" name="dashbordReturn" value="dashbordReturn">
                    <button type="submit" class="btn btn-success"><i class="fas fa-fw fa-{$buttonIcon}" aria-hidden="true"></i>{$button}</button>
                </form>
            </div>
        </main>
        <!-- /main -->
    </div>
</body>
</html>
EOF;

    return true;
}
/* ログアウト時・インストール完了時の表示
********************************************* */
function showFinished($mode) {
    //パラメータ
    $showMode = _h($mode);
    $finishedLang = _h(GLOBAL_APP_LANG);
    $finishedEncode = _h(GLOBAL_APP_ENCODE);
    $finishedSiteName = _h(GLOBAL_SITENAME);
    $finishedThemeColor = _h(GLOBAL_THEME_COLOR);
    //トークン
    $token = _h(generateToken());
    //表示文字
    $title = '';
    $heading = '';
    $headingIcon = '';
    $button = 'サイトを表示';
    $buttonIcon = 'eye';
    if($mode === SHOW_MODE['lo']) {
        $title = 'ログアウトしました';
        $heading = 'Logouted';
        $headingIcon = 'torii-gate';
        $contents = 'ログアウトしました。サイトの閲覧に戻るには「サイトを表示」ボタンをクリックしてください。';
    }
    else if($mode === SHOW_MODE['is']) {
        $title = 'インストール完了!';
        $heading = 'Installed!';
        $headingIcon = 'grin-squint';
        $contents = 'インストールが完了しました。サイトを閲覧するには「サイトを表示」ボタンをクリックしてください。';
    }
    header('Content-Type: text/html; charset=UTF-8');
    echo <<< EOF
<!DOCTYPE html>
<html lang="{$finishedLang}">
<head>
    <meta charset="{$finishedEncode}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no,address=no,email=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$title} | {$finishedSiteName}</title>
    <!-- theme color -->
    <meta name="theme-color" content="{$finishedThemeColor}">
    <!-- css -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body class="{$showMode}" id="{$showMode}">
    <div id="wrapper">
        <!-- main -->
        <main class="main">
            <div class="container-fluid mb-4">
                <div class="pb-2 mt-4 mb-2 border-bottom">
                    <h2><i class="fas fa-fw fa-{$headingIcon}" aria-hidden="true"></i>{$heading}</h2>
                </div>
                <p>{$contents}</p>
            </div>
            <div class="container-fluid">
                <a href="./" class="btn btn-light mt-3"><i class="fas fa-fw fa-{$buttonIcon}" aria-hidden="true"></i>{$button}</a>
            </div>
        </main>
        <!-- /main -->
    </div>
</body>
</html>
EOF;

    return true;
}
/* ********************************************
 *                                            *
 * 初期化                                      *
 *                                            *
 ******************************************** */
$copyRightYear = copyrightYears(_h(GLOBAL_COPYRIGHT_YEAR));
$appCopyRightYear = copyrightYears(_h(GLOBAL_APP_COPYRIGHT_YEAR));
/* ********************************************
 *                                            *
 * メイン処理                                   *
 *                                            *
 ******************************************** */
$contentsData = _jd(CONTENTS_DATA);
/* インストール済
********************************************* */
if(MODE_INSTALLED) {
    /* ログイン・ログアウト・管理画面
    ********************************************* */
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $loginRequest = filter_input(INPUT_POST, 'loginRequest');
        $logoutRequest = filter_input(INPUT_POST, 'logoutRequest');
        $contentsNewRequest = filter_input(INPUT_POST, 'contentsNewRequest');
        $contentsUpdateRequest = filter_input(INPUT_POST, 'contentsUpdateRequest');
        $contentsDeleteRequest = filter_input(INPUT_POST, 'contentsDeleteRequest');
        $siteRequest = filter_input(INPUT_POST, 'siteRequest');
        $accountRequest = filter_input(INPUT_POST, 'accountRequest');
        $mastodonRequest = filter_input(INPUT_POST, 'mastodonRequest');
        /* ログアウト処理
        ********************************************* */
        if(!empty($logoutRequest)) {
            //トークンチェック
            if (!validateToken(filter_input(INPUT_POST, 'token'))) {
                $errMsg[] = ERR_MSG99;
                http_response_code(400); //400 Bad Request
            }
            if(count($errMsg)) { //ログアウトが失敗したとき
                $errFlg = true;
            }
            else {
                setcookie(session_name(), '', 1); //セッション用Cookieの破棄
                session_destroy(); //セッションファイルの破棄
                showFinished(SHOW_MODE['lo']);
                exit();
            }
        }
        /* ログイン処理
        ********************************************* */
        else if(!empty($loginRequest)) {
            //入力を受け取る
            $loginUserid = filter_input(INPUT_POST, 'loginUserID');
            $loginPassword = filter_input(INPUT_POST, 'loginPassword');
            //トークンチェック
            if (!validateToken(filter_input(INPUT_POST, 'token'))) {
                $errMsg[] = ERR_MSG99;
                http_response_code(400); //400 Bad Request
            }
            //ユーザID、パスワードチェック
            if (empty($loginUserid) || $loginUserid !== GLOBAL_USER_ID || empty($loginPassword) ||
                !password_verify($loginPassword, GLOBAL_USER_PS)) {
                $errMsg[] = ERR_MSG61;
            }
            //チェック
            if(count($errMsg)) { //認証が失敗したとき
                $errFlg = true;
                http_response_code(403); //403 Forbidden
            }
            else { //認証が成功したとき
                session_regenerate_id(true); //セッションIDの追跡を防ぐ
                $_SESSION['userid'] = $loginUserid; //ユーザIDをセット
                $modeLogin = requireLoginedSession();
            }
        }
        /* コンテンツ管理
        ********************************************* */
        /* 新規作成
        ********************************************* */
        else if(!empty($contentsNewRequest)) {
            //トークンチェック
            if (!validateToken(filter_input(INPUT_POST, 'token'))) {
                $errMsg[] = ERR_MSG99;
                http_response_code(400); //400 Bad Request
            }
            //タイトル
            $contentsNewTitle = filter_input(INPUT_POST, 'contentsNewTitle');
            //本文
            $contentsNewContents = filter_input(INPUT_POST, 'contentsNewContents');
            //ハッシュタグ
            $contentsNewHashTags = filter_input(INPUT_POST, 'contentsNewHashTags');
            //画像パス
            $contentsNewImgPath = filter_input(INPUT_POST, 'contentsNewImgPath');
            //曜日or日付
            $contentsNewWeekDate = filter_input(INPUT_POST, 'contentsNewWeekDate');
            //曜日
            $contentsNewWeek = filter_input(INPUT_POST, 'contentsNewWeek', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY); //配列
            //日付
            $contentsNewDateYear = filter_input(INPUT_POST, 'contentsNewDateYear');
            $contentsNewDateMonth = filter_input(INPUT_POST, 'contentsNewDateMonth');
            $contentsNewDateDay = filter_input(INPUT_POST, 'contentsNewDateDay');
            //時間
            $contentsNewTime = filter_input(INPUT_POST, 'contentsNewTime');
            if($contentsNewWeekDate === WEEK_DATE['we']) { //曜日指定の場合
                if(count($contentsNewWeek) <= 0) { //曜日がチェックされていない
                    $errMsg[] = ERR_MSG85;
                }
                else {
                    if(empty($contentsNewTime)) { //日付指定はあるが時間指定がない場合
                        $contentsNewTime = '00:00'; //0時とする
                    }
                }
            }
            else if($contentsNewWeekDate === WEEK_DATE['dt']) { //日付指定の場合
                if((!empty($contentsNewDateYear) && (empty($contentsNewDateMonth) || empty($contentsNewDateDay))) || (!empty($contentsNewDateYear) && !empty($contentsNewDateMonth) && empty($contentsNewDateDay))) { //年は指定されているが月日が指定されていないor年と月は指定されているが日が空っぽ
                    $errMsg[] = ERR_MSG86;
                }
                if(empty($contentsNewTime)) { //時間指定がない場合
                    $contentsNewTime = '00:00'; //0時とする
                }
            }
            //キーワード
            $contentsNewKeywords = filter_input(INPUT_POST, 'contentsNewKeywords');
            //最終更新日付
            $contentsNewLastDate = date('c');
            //チェック
            if(count($errMsg)) {
                $errFlg = true;
            }
            else {
                $contentsArray = _jd(CONTENTS_DATA);
                $contentsNewWeekStr = '';
                if(!empty($contentsNewWeek)) {
                    $contentsNewWeekStr = _ca($contentsNewWeek);
                }
                $contentsArray[] = contentsCreate($contentsNewTitle, $contentsNewContents, $contentsNewHashTags, $contentsNewImgPath, $contentsNewWeekDate, $contentsNewWeekStr, $contentsNewDateYear, $contentsNewDateMonth, $contentsNewDateDay, $contentsNewTime, $contentsNewKeywords, $contentsNewLastDate); //追加
                $contentsArray = sortLastActivityDate($contentsArray); //コンテンツ内容を最終更新日付降順でソート
                $contentJsonStr = _je($contentsArray);
                $readFile = new SplFileObject(__FILE__, 'r');
                //ファイル操作
                $fileData = '';
                while (!$readFile->eof()) {
                    $line = $readFile->fgets();
                    //コンテンツ
                    $line = preg_replace('/^const CONTENTS_DATA = \'(.*)\';/', 'const CONTENTS_DATA = \'' . _q($contentJsonStr) . '\';', $line);
                    $fileData .= $line;
                }
                //ファイル書き込み
                try {
                    $writeFile = new SplFileObject(__FILE__, 'w');
                    $result = $writeFile->fwrite($fileData);
                    if($result == NULL) {
                        throw new Exception(ERR_MSG70);
                    }
                } catch (Exception $e) {
                    echo $e->getMessage(), "\n";
                }
                $readMastodon = new SplFileObject(MASTODON_FILE, 'r');
                //ファイル操作
                $mastodonData = '';
                while (!$readMastodon->eof()) {
                    $line = $readMastodon->fgets();
                    //コンテンツ
                    $line = preg_replace('/^const CONTENTS_DATA = \'(.*)\';/', 'const CONTENTS_DATA = \'' . _q($contentJsonStr) . '\';', $line);
                    $mastodonData .= $line;
                }
                //ファイル書き込みMASTODON_FILE
                try {
                    $writeMastodon = new SplFileObject(MASTODON_FILE, 'w');
                    $result = $writeMastodon->fwrite($mastodonData);
                    if($result == NULL) {
                        throw new Exception(ERR_MSG70);
                    }
                    dashboardFinished(SHOW_MODE['co']); //完了画面表示
                    exit();
                } catch (Exception $e) {
                    echo $e->getMessage(), "\n";
                }
            }
        }
        /* 更新
        ********************************************* */
        else if(!empty($contentsUpdateRequest)) {
            //トークンチェック
            if (!validateToken(filter_input(INPUT_POST, 'token'))) {
                $errMsg[] = ERR_MSG99;
                http_response_code(400); //400 Bad Request
            }
            //ID
            $updateID = -1;
            $contentsUpdateID = filter_input(INPUT_POST, 'contentsUpdateID');
            $contentsArray = _jd(CONTENTS_DATA);
            if(empty($contentsUpdateID) && $contentsUpdateID !== '0') { //IDがパラメータで渡ってこなかったとき
                $errMsg[] = ERR_MSG50;
            }
            else {
                $updateID = (int)$contentsUpdateID;
                if(!array_key_exists($updateID, $contentsArray)) { //指定するIDが存在しなかった場合
                    $errMsg[] = ERR_MSG51;
                }
            }
            //タイトル
            $contentsUpdateTitle = filter_input(INPUT_POST, 'contentsUpdateTitle');
            //本文
            $contentsUpdateContents = filter_input(INPUT_POST, 'contentsUpdateContents');
            //ハッシュタグ
            $contentsUpdateHashTags = filter_input(INPUT_POST, 'contentsUpdateHashTags');
            //画像パス
            $contentsUpdateImgPath = filter_input(INPUT_POST, 'contentsUpdateImgPath');
            //曜日or日付
            $contentsUpdateWeekDate = filter_input(INPUT_POST, 'contentsUpdateWeekDate');
            //曜日
            $contentsUpdateWeek = filter_input(INPUT_POST, 'contentsUpdateWeek', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY); //配列
            //日付
            $contentsUpdateDateYear = filter_input(INPUT_POST, 'contentsUpdateDateYear');
            $contentsUpdateDateMonth = filter_input(INPUT_POST, 'contentsUpdateDateMonth');
            $contentsUpdateDateDay = filter_input(INPUT_POST, 'contentsUpdateDateDay');
            //時間
            $contentsUpdateTime = filter_input(INPUT_POST, 'contentsUpdateTime');
            if($contentsUpdateWeekDate === WEEK_DATE['we']) { //曜日指定の場合
                if(count($contentsUpdateWeek) <= 0) { //曜日がチェックされていない
                    $errMsg[] = ERR_MSG85;
                }
                else {
                    if(empty($contentsUpdateTime)) { //日付指定はあるが時間指定がない場合
                        $contentsUpdateTime = '00:00'; //0時とする
                    }
                }
            }
            else if($contentsUpdateWeekDate === WEEK_DATE['dt']) { //日付指定の場合
                if((!empty($contentsUpdateDateYear) && (empty($contentsUpdateDateMonth) || empty($contentsUpdateDateDay))) || (!empty($contentsUpdateDateYear) && !empty($contentsUpdateDateMonth) && empty($contentsUpdateDateDay))) { //年は指定されているが月日が指定されていないor年と月は指定されているが日が空っぽ
                    $errMsg[] = ERR_MSG86;
                }
                if(empty($contentsUpdateTime)) { //日付指定はあるが時間指定がない場合
                        $contentsUpdateTime = '00:00'; //0時とする
                    }
            }
            //キーワード
            $contentsUpdateKeywords = filter_input(INPUT_POST, 'contentsUpdateKeywords');
            //最終更新日付
            $contentsUpdateLastDate = date('c');
            //チェック
            if(count($errMsg)) {
                $errFlg = true;
            }
            else {
                $contentsUpdateWeekStr = '';
                if(!empty($contentsUpdateWeek)) {
                    $contentsUpdateWeekStr = _ca($contentsUpdateWeek);
                }
                $contentsArray[$updateID] = contentsCreate($contentsUpdateTitle, $contentsUpdateContents, $contentsUpdateHashTags, $contentsUpdateImgPath, $contentsUpdateWeekDate, $contentsUpdateWeekStr, $contentsUpdateDateYear, $contentsUpdateDateMonth, $contentsUpdateDateDay, $contentsUpdateTime, $contentsUpdateKeywords, $contentsUpdateLastDate); //更新
                $contentsArray = sortLastActivityDate($contentsArray); //コンテンツ内容を最終更新日付降順でソート
                //文字列に再変換
                $contentJsonStr = _je($contentsArray);
                $readFile = new SplFileObject(__FILE__, 'r');
                //ファイル操作
                $fileData = '';
                while (!$readFile->eof()) {
                    $line = $readFile->fgets();
                    //コンテンツ
                    $line = preg_replace('/^const CONTENTS_DATA = \'(.*)\';/', 'const CONTENTS_DATA = \'' . _q($contentJsonStr) . '\';', $line);
                    $fileData .= $line;
                }
                //ファイル書き込み
                try {
                    $writeFile = new SplFileObject(__FILE__, 'w');
                    $result = $writeFile->fwrite($fileData);
                    if($result == NULL) {
                        throw new Exception(ERR_MSG70);
                    }
                } catch (Exception $e) {
                    echo $e->getMessage(), "\n";
                }
                $readMastodon = new SplFileObject(MASTODON_FILE, 'r');
                //ファイル操作
                $MastodonData = '';
                while (!$readMastodon->eof()) {
                    $line = $readMastodon->fgets();
                    //コンテンツ
                    $line = preg_replace('/^const CONTENTS_DATA = \'(.*)\';/', 'const CONTENTS_DATA = \'' . _q($contentJsonStr) . '\';', $line);
                    $MastodonData .= $line;
                }
                //ファイル書き込み
                try {
                    $writeMastodon = new SplFileObject(MASTODON_FILE, 'w');
                    $result = $writeMastodon->fwrite($MastodonData);
                    if($result == NULL) {
                        throw new Exception(ERR_MSG70);
                    }
                    dashboardFinished(SHOW_MODE['co']); //完了画面表示
                    exit();
                } catch (Exception $e) {
                    echo $e->getMessage(), "\n";
                }
            }
        }
        /* 削除
        ********************************************* */
        else if(!empty($contentsDeleteRequest)) {
            //トークンチェック
            if (!validateToken(filter_input(INPUT_POST, 'token'))) {
                $errMsg[] = ERR_MSG99;
                http_response_code(400); //400 Bad Request
            }
            //ID
            $deleteID = -1;
            $contentsDeleteID = filter_input(INPUT_POST, 'contentsDeleteID');
            $contentsArray = _jd(CONTENTS_DATA);
            if(empty($contentsDeleteID) && $contentsDeleteID !== '0') { //IDがパラメータで渡ってこなかったとき
                $errMsg[] = ERR_MSG52;
            }
            else {
                $deleteID = (int)$contentsDeleteID;
                if(!array_key_exists($deleteID, $contentsArray)) { //指定するIDが存在しなかった場合
                    $errMsg[] = ERR_MSG51;
                }
            }
            //チェック
            if(count($errMsg)) {
                $errFlg = true;
            }
            else {
                unset($contentsArray[$deleteID]); //削除
                $contentsArray = array_values($contentsArray);
                $contentJsonStr = _je($contentsArray);
                $readFile = new SplFileObject(__FILE__, 'r');
                //ファイル操作
                $fileData = '';
                while (!$readFile->eof()) {
                    $line = $readFile->fgets();
                    //コンテンツ
                    $line = preg_replace('/^const CONTENTS_DATA = \'(.*)\';/', 'const CONTENTS_DATA = \'' . _q($contentJsonStr) . '\';', $line);
                    $fileData .= $line;
                }
                //ファイル書き込み
                try {
                    $writeFile = new SplFileObject(__FILE__, 'w');
                    $result = $writeFile->fwrite($fileData);
                    if($result == NULL) {
                        throw new Exception(ERR_MSG70);
                    }
                    dashboardFinished(SHOW_MODE['co']); //完了画面表示
                    exit();
                } catch (Exception $e) {
                    echo $e->getMessage(), "\n";
                }
            }
        }
        /* サイト設定変更
        ********************************************* */
        else if(!empty($siteRequest)) {
            //トークンチェック
            if (!validateToken(filter_input(INPUT_POST, 'token'))) {
                $errMsg[] = ERR_MSG99;
                http_response_code(400); //400 Bad Request
            }
            //サイト名
            $siteSiteName = filter_input(INPUT_POST, 'siteSiteName');
            if(empty($siteSiteName)) {
                $errMsg[] = ERR_MSG80 . ' (サイト名)';
            }
            //説明
            $siteDescription = filter_input(INPUT_POST, 'siteDescription');
            if(empty($siteDescription)) {
                $siteDescription = GLOBAL_DESCRIPTION; //以前の設定をそのまま引き継ぐ
            }
            //テーマカラー
            $siteThemeColor = filter_input(INPUT_POST, 'siteThemeColor');
            if(empty($siteThemeColor)) {
                $siteThemeColor = GLOBAL_THEME_COLOR; //以前の設定をそのまま引き継ぐ
            }
            //発行年数
            $siteCRYear = filter_input(INPUT_POST, 'siteCRYear');
            if(empty($siteCRYear)) {
                $errMsg[] = ERR_MSG80 . ' (年)';
            }
            //OGP・Twitterアカウント
            $siteOGPTUserID = filter_input(INPUT_POST, 'siteOGPTUserID');
            if(empty($siteOGPTUserID)) {
                $siteOGPTUserID = GLOBAL_OGP_TWITTER_ACCOUNT; //以前の設定をそのまま引き継ぐ
            }
            //OGP・画像
            $siteOGPImage = filter_input(INPUT_POST, 'siteOGPImage');
            if(empty($siteOGPImage)) {
                $siteOGPImage = GLOBAL_OGP_IMAGE; //以前の設定をそのまま引き継ぐ
            }
            //OGP・URL
            $siteOGPURL = filter_input(INPUT_POST, 'siteOGPURL');
            if(empty($siteOGPURL)) {
                $siteOGPURL = GLOBAL_OGP_URL; //以前の設定をそのまま引き継ぐ
            }
            //チェック
            if(count($errMsg)) {
                $errFlg = true;
            }
            else {
                $readFile = new SplFileObject(__FILE__, 'r');
                //ファイル操作
                $fileData = '';
                while (!$readFile->eof()) {
                    $line = $readFile->fgets();
                    //サイト名
                    $line = preg_replace('/^const GLOBAL_SITENAME = \'(.*)\';/', 'const GLOBAL_SITENAME = \'' . _q($siteSiteName) . '\';', $line);
                    //説明
                    $line = preg_replace('/^const GLOBAL_DESCRIPTION = \'(.*)\';/', 'const GLOBAL_DESCRIPTION = \'' . _q($siteDescription) . '\';', $line);
                    //テーマカラー
                    $line = preg_replace('/'. GLOBAL_THEME_COLOR .'/', _q($siteThemeColor), $line);
                    $line = preg_replace('/^const GLOBAL_THEME_COLOR = \'(.*)\';/', 'const GLOBAL_THEME_COLOR = \'' . _q($siteThemeColor) . '\';', $line);
                    //年
                    $line = preg_replace('/^const GLOBAL_COPYRIGHT_YEAR = \'(.*)\';/', 'const GLOBAL_COPYRIGHT_YEAR = \'' . _q($siteCRYear) . '\';', $line);
                    //OGP
                    $line = preg_replace('/^const GLOBAL_OGP_TWITTER_ACCOUNT = \'(.*)\';/', 'const GLOBAL_OGP_TWITTER_ACCOUNT = \'' . _q($siteOGPTUserID) . '\';', $line);
                    $line = preg_replace('/^const GLOBAL_OGP_IMAGE = \'(.*)\';/', 'const GLOBAL_OGP_IMAGE = \'' . _q($siteOGPImage) . '\';', $line);
                    $line = preg_replace('/^define\(\'GLOBAL_OGP_URL\', (.*)\);/', 'define(\'GLOBAL_OGP_URL\', \'' . _q($siteOGPURL) . '\');', $line);
                    $fileData .= $line;
                }
                //ファイル書き込み
                try {
                    $writeFile = new SplFileObject(__FILE__, 'w');
                    $result = $writeFile->fwrite($fileData);
                    if($result == NULL) {
                        throw new Exception(ERR_MSG70);
                    }
                    dashboardFinished(SHOW_MODE['st']); //完了画面表示
                    exit();
                } catch (Exception $e) {
                    echo $e->getMessage(), "\n";
                }
            }
        }
        /* アカウント設定変更
        ********************************************* */
        else if(!empty($accountRequest)) {
            //トークンチェック
            if (!validateToken(filter_input(INPUT_POST, 'token'))) {
                $errMsg[] = ERR_MSG99;
                http_response_code(400); //400 Bad Request
            }
            $accountNewPassword = '';
            //ユーザID
            $accountUserID = filter_input(INPUT_POST, 'accountUserID');
            if(empty($accountUserID)) {
                $errMsg[] = ERR_MSG80 . ' (ユーザID)';
            }
            else {
                if(!preg_match('/\A[a-z\d]{3,100}+\z/i', $accountUserID)) {
                    $errMsg[] = ERR_MSG81 . ' (ユーザID)';
                }
            }
            //ユーザ名
            $accountUserName = filter_input(INPUT_POST, 'accountUserName');
            if(empty($accountUserName)) {
                $accountUserName = $accountUserID; //ユーザIDをユーザ名に
            }
            //サイトURL
            $accountUserSite = filter_input(INPUT_POST, 'accountUserSite');
            if(empty($accountUserSite)) {
                $accountUserSite = GLOBAL_AUHTOR_URL; //以前の設定をそのまま引き継ぐ
            }
            //現在のパスワード
            $accountNowPasswordStr = filter_input(INPUT_POST, 'accountNowPassword');
            if(!empty($accountNowPasswordStr)) { //空欄の場合は変更処理をしない
                if(!password_verify($accountNowPasswordStr, GLOBAL_USER_PS)) { //一致しない場合エラー
                    $errMsg[] = ERR_MSG83;
                }
                //新しいパスワード
                $accountNewPasswordStr = filter_input(INPUT_POST, 'accountNewPassword');
                $accountConfirmPasswordStr = filter_input(INPUT_POST, 'accountConfirmPassword');
                if(empty($accountNewPasswordStr) || empty($accountConfirmPasswordStr)) {
                    $errMsg[] = ERR_MSG80 . ' (新しいパスワードか、再入力の新しいパスワードのいずれか)';
                }
                else {
                    if(!preg_match('/\A(?=.*?[a-z])(?=.*?[A-Z])(?=.*?\d)(?=.*?[!-\/:-@[-`{-~])[!-~]{8,100}+\z/', $accountNewPasswordStr)) { //複雑さを満たしていない
                        $errMsg[] = ERR_MSG82 . ' (新しいパスワード)';
                    }
                    else if($accountNewPasswordStr !== $accountConfirmPasswordStr) { //確認用と一致しない
                        $errMsg[] = ERR_MSG83 . ' (新しいパスワード)';
                    }
                    else { //ハッシュ値に変換
                        $accountNewPassword = password_hash($accountNewPasswordStr, PASSWORD_BCRYPT);
                    }
                }
            }
            //チェック
            if(count($errMsg)) {
                $errFlg = true;
            }
            else {
                $readFile = new SplFileObject(__FILE__, 'r');
                //ファイル操作
                $fileData = '';
                while (!$readFile->eof()) {
                    $line = $readFile->fgets();
                    $line = preg_replace('/^const GLOBAL_USER_ID = \'(.*)\';/', 'const GLOBAL_USER_ID = \'' . _q($accountUserID) . '\';', $line);
                    $line = preg_replace('/^const GLOBAL_AUHTOR = \'(.*)\';/', 'const GLOBAL_AUHTOR = \'' . _q($accountUserName) . '\';', $line);
                    $line = preg_replace('/^const GLOBAL_USER_PS = \'(.*)\';/', 'const GLOBAL_USER_PS = \'' . _dl($accountNewPassword) . '\';', $line);
                    $line = preg_replace('/^const GLOBAL_AUHTOR_URL = \'(.*)\';/', 'const GLOBAL_AUHTOR_URL = \'' . _q($accountUserSite) . '\';', $line);
                    $fileData .= $line;
                }
                //ファイル書き込み
                try {
                    $writeFile = new SplFileObject(__FILE__, 'w');
                    $result = $writeFile->fwrite($fileData);
                    if($result == NULL) {
                        throw new Exception(ERR_MSG70);
                    }
                    dashboardFinished(SHOW_MODE['st']); //完了画面表示
                    exit();
                } catch (Exception $e) {
                    echo $e->getMessage(), "\n";
                }
            }
        }
        /* Mastodon設定変更
        ********************************************* */
        else if(TOOT_MODE && !empty($mastodonRequest)) {
            //トークンチェック
            if (!validateToken(filter_input(INPUT_POST, 'token'))) {
                $errMsg[] = ERR_MSG99;
                http_response_code(400); //400 Bad Request
            }
            //インスタンス
            $mastodonInstance = filter_input(INPUT_POST, 'mastodonInstance');
            if(empty($mastodonInstance)) {
                $errMsg[] = ERR_MSG80 . ' (インスタンス)';
            }
            //クライアントキー
            $mastodonClientID = filter_input(INPUT_POST, 'mastodonClientID');
            if(empty($mastodonClientID)) {
                $errMsg[] = ERR_MSG80 . ' (クライアントキー)';
            }
            //クライアントシークレット
            $mastodonClientSecret = filter_input(INPUT_POST, 'mastodonClientSecret');
            if(empty($mastodonClientSecret)) {
                $errMsg[] = ERR_MSG80 . ' (クライアントシークレット)';
            }
            //アクセストークン
            $mastodonAccessToken = filter_input(INPUT_POST, 'mastodonAccessToken');
            if(empty($mastodonAccessToken)) {
                $errMsg[] = ERR_MSG80 . ' (アクセストークン)';
            }
            //チェック
            if(count($errMsg)) {
                $errFlg = true;
            }
            else {
                $readFile = new SplFileObject(__FILE__, 'r');
                //ファイル操作
                $fileData = '';
                while (!$readFile->eof()) {
                    $line = $readFile->fgets();
                    //インスタンス
                    $line = preg_replace('/^const GLOBAL_INSTANCE = \'(.*)\';/', 'const GLOBAL_INSTANCE = \'' . _q($mastodonInstance) . '\';', $line);
                    //アカウント設定
                    $line = preg_replace('/^const GLOBAL_CLIENT_KEY = \'(.*)\';/', 'const GLOBAL_CLIENT_KEY = \'' . _q($mastodonClientID) . '\';', $line);
                    $line = preg_replace('/^const GLOBAL_CLIENT_SECRET = \'(.*)\';/', 'const GLOBAL_CLIENT_SECRET = \'' . _q($mastodonClientSecret) . '\';', $line);
                    $line = preg_replace('/^const GLOBAL_ACCESS_TOKEN = \'(.*)\';/', 'const GLOBAL_ACCESS_TOKEN = \'' . _q($mastodonAccessToken) . '\';', $line);
                    $fileData .= $line;
                }
                //ファイル書き込み
                try {
                    $writeFile = new SplFileObject(__FILE__, 'w');
                    $result = $writeFile->fwrite($fileData);
                    if($result == NULL) {
                        throw new Exception(ERR_MSG70);
                    }
                } catch (Exception $e) {
                    echo $e->getMessage(), "\n";
                }
                $readMastodon = new SplFileObject(MASTODON_FILE, 'r');
                //ファイル操作
                $mastodonData = '';
                while (!$readMastodon->eof()) {
                    $line = $readMastodon->fgets();
                    //インスタンス
                    $line = preg_replace('/^const GLOBAL_INSTANCE = \'(.*)\';/', 'const GLOBAL_INSTANCE = \'' . _q($mastodonInstance) . '\';', $line);
                    //アカウント設定
                    $line = preg_replace('/^const GLOBAL_CLIENT_KEY = \'(.*)\';/', 'const GLOBAL_CLIENT_KEY = \'' . _q($mastodonClientID) . '\';', $line);
                    $line = preg_replace('/^const GLOBAL_CLIENT_SECRET = \'(.*)\';/', 'const GLOBAL_CLIENT_SECRET = \'' . _q($mastodonClientSecret) . '\';', $line);
                    $line = preg_replace('/^const GLOBAL_ACCESS_TOKEN = \'(.*)\';/', 'const GLOBAL_ACCESS_TOKEN = \'' . _q($mastodonAccessToken) . '\';', $line);
                    $mastodonData .= $line;
                }
                //ファイル書き込み
                try {
                    $writeMastodon = new SplFileObject(MASTODON_FILE, 'w');
                    $result = $writeMastodon->fwrite($mastodonData);
                    if($result == NULL) {
                        throw new Exception(ERR_MSG70);
                    }
                    dashboardFinished(SHOW_MODE['st']); //完了画面表示
                    exit();
                } catch (Exception $e) {
                    echo $e->getMessage(), "\n";
                }
            }
        }
    }
    /* 通常・バックアップ
    ********************************************* */
    if($_SERVER['REQUEST_METHOD'] === 'GET') {
        $backupRequest = filter_input(INPUT_GET, 'backupRequest');
        $dashbordReturn = filter_input(INPUT_GET, 'dashbordReturn');
        /* バックアップ処理
        ********************************************* */
        if(!empty($backupRequest)) {
            //トークンチェック
            if (!validateToken(filter_input(INPUT_GET, 'token'))) {
                $errMsg[] = ERR_MSG99;
                http_response_code(400); //400 Bad Request
            }
            if(count($errMsg)) { //処理が失敗したとき
                $errFlg = true;
            }
            $backupPath = __FILE__; //ファイルパス
            $backupFile = 'backup.php'; //ファイル
            header('Content-Type: application/force-download');
            header('Content-Length: '.filesize($backupPath));
            header('Content-disposition: attachment; filename="'.$backupFile.'"');
            readfile($backupPath);
        }
        $backupMastodonRequest = filter_input(INPUT_GET, 'backupMastodonRequest');
        $dashbordReturn = filter_input(INPUT_GET, 'dashbordReturn');
        /* バックアップ処理(Mastodon)
        ********************************************* */
        if(!empty($backupMastodonRequest)) {
            //トークンチェック
            if (!validateToken(filter_input(INPUT_GET, 'token'))) {
                $errMsg[] = ERR_MSG99;
                http_response_code(400); //400 Bad Request
            }
            if(count($errMsg)) { //処理が失敗したとき
                $errFlg = true;
            }
            $backupPath = MASTODON_FILE; //ファイルパス
            $backupFile = 'backup_mastodon.php'; //ファイル
            header('Content-Type: application/force-download');
            header('Content-Length: '.filesize($backupPath));
            header('Content-disposition: attachment; filename="'.$backupFile.'"');
            readfile($backupPath);
        }
        /* ダッシュボードへ戻る
        ********************************************* */
        if(!empty($dashbordReturn)) {
            //トークンチェック
            if (!validateToken(filter_input(INPUT_GET, 'token'))) {
                $errMsg[] = ERR_MSG99;
                http_response_code(400); //400 Bad Request
            }
            if(count($errMsg)) { //処理が失敗したとき
                $errFlg = true;
            }
        }
    }
}
/* 未インストール
********************************************* */
else {
    /* インストール処理
    ********************************************* */
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        //postされた内容
        //トークンチェック
        if(!validateToken(filter_input(INPUT_POST, 'token'))) {
            $errMsg[] = ERR_MSG99;
            http_response_code(400); //400 Bad Request
        }
        //サイト名
        $siteName = filter_input(INPUT_POST, 'installSiteName');
        if(empty($siteName)) {
            $errMsg[] = ERR_MSG80 . ' (サイト名)';
        }
        //ユーザID
        $userID = filter_input(INPUT_POST, 'installUserID');
        if(empty($userID)) {
            $errMsg[] = ERR_MSG80 . ' (ユーザID)';
        }
        else {
            if(!preg_match('/\A[a-z\d]{3,100}+\z/i', $userID)) {
                $errMsg[] = ERR_MSG81 . ' (ユーザID)';
            }
        }
        //パスワード
        $password = '';
        $passwordStr = filter_input(INPUT_POST, 'installPassword');
        if(empty($passwordStr)) {
            $errMsg[] = ERR_MSG80 . ' (パスワード)';
        }
        else {
            if(!preg_match('/\A(?=.*?[a-z])(?=.*?[A-Z])(?=.*?\d)(?=.*?[!-\/:-@[-`{-~])[!-~]{8,100}+\z/', $passwordStr)) {
                $errMsg[] = ERR_MSG82 . ' (パスワード)';
            }
            else { //ハッシュ値に変換
                $password = password_hash($passwordStr, PASSWORD_BCRYPT);
            }
        }
        //チェック
        if(count($errMsg)) {
            $errFlg = true;
        }
        else {
            $readFile = new SplFileObject(__FILE__, 'r');
            //ファイル操作
            $fileData = '';
            while (!$readFile->eof()) {
                $line = $readFile->fgets();
                $line = preg_replace('/^const GLOBAL_SITENAME = \'(.*)\';/', 'const GLOBAL_SITENAME = \'' . _q($siteName) . '\';', $line);
                $line = preg_replace('/^const GLOBAL_USER_ID = \'(.*)\';/', 'const GLOBAL_USER_ID = \'' . _q($userID) . '\';', $line);
                $line = preg_replace('/^const GLOBAL_AUHTOR = \'(.*)\';/', 'const GLOBAL_AUHTOR = \'' . _q($userID) . '\';', $line);
                $line = preg_replace('/^const GLOBAL_USER_PS = \'(.*)\';/', 'const GLOBAL_USER_PS = \'' . _dl($password) . '\';', $line);
                $line = preg_replace('/^const MODE_INSTALLED = 0;/', 'const MODE_INSTALLED = 1;', $line);
                $fileData .= $line;
            }
            //ファイル書き込み
            try {
                $writeFile = new SplFileObject(__FILE__, 'w');
                $result = $writeFile->fwrite($fileData);
                if($result == NULL) {
                    throw new Exception(ERR_MSG70);
                }
                showFinished(SHOW_MODE['is']);
                exit();
            } catch (Exception $e) {
                echo $e->getMessage(), "\n";
            }
        }
    }
    /* インストール開始
    ********************************************* */
    else {}
}
?><!DOCTYPE html>
<html lang="<?=_h(GLOBAL_APP_LANG)?>">
<head>
    <meta charset="<?=_h(GLOBAL_APP_ENCODE)?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no,address=no,email=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
if($modeLogin) { //ログイン中
?>
    <title>管理画面 | <?=_h(GLOBAL_SITENAME)?></title>
<?php
}
else { //通常
?>
    <title><?=_h(GLOBAL_DESCRIPTION)?> | <?=_h(GLOBAL_SITENAME)?></title>
<?php
}
?>
    <meta name="description" content="<?=_h(GLOBAL_DESCRIPTION)?>">

    <!-- no cache -->
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="Expires" content="<?=_h(date('c'))?>">

    <!-- theme color -->
    <meta name="theme-color" content="<?=_h(GLOBAL_THEME_COLOR)?>">

    <!-- css -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style type="text/css">
<!-- KATSURAGI_CSS -->
    </style>
<?php
if(!MODE_INSTALLED || $modeLogin) { //未インストールorログイン中
    //インデックスしないようにmetaタグ追加
?>
    <meta name="robots" content="noindex,follow" />
<?php
}
if(MODE_INSTALLED) { //インストール済
?>
    <!-- twitter card -->
    <meta name="twitter:card" content="photo" />
    <meta name="twitter:site" content="@<?=_h(GLOBAL_OGP_TWITTER_ACCOUNT)?>" />
    <meta property="og:type" content="website" />
    <meta name="og:title" content="<?=_h(GLOBAL_SITENAME)?>" />
    <meta name="og:site_name" content="<?=_h(GLOBAL_SITENAME)?>" />
    <meta name="og:description" content="<?=_h(GLOBAL_DESCRIPTION)?>" />
    <meta name="og:image" content="<?=_h(GLOBAL_OGP_IMAGE)?>" />
    <meta name="og:url" content="<?=_h(GLOBAL_OGP_URL)?>" />
<?php
}
?>
</head>
<?php
/* ********************************************
 *                                            *
 * HTTP Status Code Error                     *
 *                                            *
 ******************************************** */
if (http_response_code() >= 400) {
    $statusMessage = '';
    $paragraphMessage = '通信エラーが発生しました。前のページに戻ってやりなおしてください。';
    if(http_response_code() === 400) { $statusMessage = 'Bad Request.'; }
    if(http_response_code() === 401) { $statusMessage = 'Unauthorized'; }
    if(http_response_code() === 403) { $statusMessage = 'Forbidden'; }
    if(http_response_code() === 404) { $statusMessage = 'Not Found'; }
    if(http_response_code() === 418) { $statusMessage = 'I\'m a teapot'; }
    if(http_response_code() === 500) { $statusMessage = 'Internal Server Error'; }
    if(http_response_code() === 502) { $statusMessage = 'Bad Gateway'; }
    if(http_response_code() === 503) { $statusMessage = 'Service Unavailable'; }
    if(http_response_code() === 511) { $statusMessage = 'Network Authentication Required'; }
?>
<body class="error" id="error">
    <div id="wrapper">
        <!-- header -->
        <header class="header">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="./"><?=_h(GLOBAL_SITENAME)?></a>
            </nav>
        </header>
        <!-- /header -->
        <!-- main -->
        <main class="main installMain">
            <div class="container-fluid mb-4">
                <div class="pb-2 mt-4 mb-2 border-bottom">
                    <h2><i class="fas fa-fw fa-exclamation-triangle" aria-hidden="true"></i><?=_h(http_response_code())?> <?=_h($statusMessage)?></h2>
                </div>
                <p><?=_h($paragraphMessage)?></p>
            </div>
            <div class="container-fluid">
                <a href="#" class="btn btn-light mt-3" id="goBack"><i class="fas fa-fw fa-undo" aria-hidden="true"></i>前のページに戻る</a>
            </div>
        </main>
        <!-- /main -->
        <div class="returnPageTop"><i class="fas fa-fw fa-arrow-up" aria-hidden="true"></i></div>
        <!-- footer -->
        <footer class="footer">
            <small class="copyRight">Copyright © <?=_h($copyRightYear)?> <a href="<?=_h(GLOBAL_AUHTOR_URL)?>"><?=_h(GLOBAL_AUHTOR)?></a> All Right Reserved.</small>
            <small class="copyRight">Powered by <a href="<?=_h(GLOBAL_APP_URL)?>"><?=_h(GLOBAL_APP_NAME)?> (ver.<?=_h(GLOBAL_APP_VERSION)?>)</a></small>
        </footer>
        <!-- /footer -->
    </div>
<?php
} //HTTPエラーページ ここまで
/* ********************************************
 *                                            *
 * エラー表示                                   *
 *                                            *
 ******************************************** */
else if($errFlg) { //エラーの場合
?>
<body class="error" id="error">
    <div id="wrapper">
        <!-- header -->
        <header class="header">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#"><?=_h(GLOBAL_SITENAME)?></a>
            </nav>
        </header>
        <!-- /header -->
        <!-- main -->
        <main class="main installMain">
            <div class="container-fluid mb-4">
                <div class="pb-2 mt-4 mb-2 border-bottom">
                    <h2><i class="fas fa-fw fa-exclamation-triangle" aria-hidden="true"></i>Error</h2>
                </div>
                <p>下記エラーがあります。前のページに戻って修正してください。</p>
            </div>
            <div class="container-fluid">
<?php
    if(count($errMsg) > 0) {
?>
                <ul>
<?php
        foreach($errMsg as $msg) {
?>
                    <li><?=$msg?></li>
<?php
        }
?>
                </ul>
<?php
    }
?>
                <a href="#" class="btn btn-light mt-3" id="goBack"><i class="fas fa-fw fa-undo" aria-hidden="true"></i>前のページに戻る</a>
            </div>
        </main>
        <!-- /main -->
        <div class="returnPageTop"><i class="fas fa-fw fa-arrow-up" aria-hidden="true"></i></div>
        <!-- footer -->
        <footer class="footer">
            <small class="copyRight">Copyright © <?=_h($copyRightYear)?> <a href="<?=_h(GLOBAL_AUHTOR_URL)?>"><?=_h(GLOBAL_AUHTOR)?></a> All Right Reserved.</small>
            <small class="copyRight">Powered by <a href="<?=_h(GLOBAL_APP_URL)?>"><?=_h(GLOBAL_APP_NAME)?> (ver.<?=_h(GLOBAL_APP_VERSION)?>)</a></small>
        </footer>
        <!-- /footer -->
    </div>
<?php
} //エラーページ ここまで
/* ********************************************
 *                                            *
 * インストール画面                              *
 *                                            *
 ******************************************** */
else if(!MODE_INSTALLED) { //未インストール
?>
<body class="install" id="install">
    <div id="wrapper">
        <!-- header -->
        <header class="header">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#"><?=_h(GLOBAL_APP_NAME)?></a>
            </nav>
        </header>
        <!-- /header -->
        <!-- main -->
        <main class="main installMain">
            <div class="container-fluid mb-4">
                <div class="pb-2 mt-4 mb-2 border-bottom">
                    <h2><i class="fas fa-fw fa-download" aria-hidden="true"></i>Install</h2>
                </div>
                <p><?=_h(GLOBAL_APP_NAME)?>(ver.<?=_h(GLOBAL_APP_VERSION)?>)をインストールします。下記項目を入力し、「送信」ボタンを押してください。</p>
            </div>
            <div class="container-fluid">
                <form method="post" action="./">
                    <div class="pb-2 mt-4 mb-2 border-bottom">
                        <h3><i class="fas fa-fw fa-globe-americas" aria-hidden="true"></i>Site Settings</h3>
                    </div>
                    <div class="form-group row">
                        <label for="installSiteName" class="col-md-2 col-form-label" data-toggle="tooltip" title="Webサイトの名前です。"><i class="fas fa-fw fa-file-signature" aria-hidden="true"></i>サイト名<span class="badge badge-warning">必須</span></label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="installSiteName" id="installSiteName" placeholder="<?=_h(GLOBAL_APP_NAME)?>" required="required">
                        </div>
                    </div>
                    <div class="pb-2 mt-4 mb-2 border-bottom">
                        <h3><i class="fas fa-fw fa-id-card" aria-hidden="true"></i>User Settings</h3>
                    </div>
                    <div class="form-group row">
                        <label for="installUserID" class="col-md-2 col-form-label" data-toggle="tooltip" title="管理画面ログイン時に使用します。3文字以上100文字以下の半角英数字で入力してください。"><i class="fas fa-fw fa-id-badge" aria-hidden="true"></i>ユーザID<span class="badge badge-warning">必須</span></label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="installUserID" id="installUserID" placeholder="<?=_h(GLOBAL_USER_ID)?>" required="required" pattern="^[a-zA-Z\d]{3,100}$">
                            <small class="form-text text-muted">3文字以上100文字以下の半角英数字で入力してください。</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="installPassword" class="col-md-2 col-form-label" data-toggle="tooltip" title="管理画面ログイン時に使用します。8文字以上100文字以下で、半角英数字と記号を組み合わせたものを設定してください。"><i class="fas fa-fw fa-key" aria-hidden="true"></i>パスワード<span class="badge badge-warning">必須</span></label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="installPassword" id="installPassword" placeholder="" required="required" pattern="^(?=.*?[a-z])(?=.*?[A-Z])(?=.*?\d)(?=.*?[!-/:-@[-`{-~])[!-~]{8,100}$">
                            <small class="form-text text-muted">8文字以上100文字以下で、半角英数字と記号を組み合わせてください。</small>
                        </div>
                    </div>
                    <input type="hidden" name="token" value="<?=_h(generateToken())?>">
                    <button type="submit" class="btn btn-primary mt-3"><i class="fas fa-fw fa-paper-plane" aria-hidden="true"></i>送信する</button>
                </form>
            </div>
        </main>
        <!-- /main -->
        <div class="returnPageTop"><i class="fas fa-fw fa-arrow-up" aria-hidden="true"></i></div>
        <!-- footer -->
        <footer class="footer">
            <small class="copyRight">Copyright © <?=_h($appCopyRightYear)?> <a href="<?=_h(GLOBAL_APP_AUHTOR_URL)?>"><?=_h(GLOBAL_APP_AUHTOR)?></a> All Right Reserved.</small>
            <small class="copyRight">Powered by <a href="<?=_h(GLOBAL_APP_URL)?>"><?=_h(GLOBAL_APP_NAME)?> (ver.<?=_h(GLOBAL_APP_VERSION)?>)</a></small>
        </footer>
        <!-- /footer -->
    </div>
<?php
} //インストール画面 ここまで
/* ********************************************
 *                                            *
 * 通常                                        *
 *                                            *
 ******************************************** */
else { //インストール済
    if(!$modeLogin) { //フロントページ
?>
<body class="index" id="index">
    <div id="wrapper">
        <!-- header -->
        <header class="header">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="./"><?=_h(GLOBAL_SITENAME)?></a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="ナビゲーションの切替">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbar">
                    <form class="form-inline ml-auto mr-2">
                        <i class="fas fa-fw fa-search" aria-hidden="true"></i><input class="form-control search" type="text" placeholder="検索" aria-label="検索">
                    </form>
                    <ul class="navbar-nav mr-5">
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle mr-5" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ログイン</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <form action="./" method="post">
                                    <div class="form-group mx-2">
                                        <label for="loginUserID"><i class="fas fa-fw fa-id-badge" aria-hidden="true"></i>ユーザID</label>
                                        <input type="text" class="form-control" name="loginUserID" id="loginUserID" placeholder="ユーザID" required="required" pattern="^[a-zA-Z\d]{3,100}$">
                                    </div>
                                    <div class="form-group mx-2">
                                        <label for="loginPassword"><i class="fas fa-fw fa-key" aria-hidden="true"></i>パスワード</label>
<?php
if(DEBUG_MODE) {
?>
                                        <input type="text" class="form-control" name="loginPassword" id="loginPassword" placeholder="パスワード" required="required">
<?php
} else {
?>
                                        <input type="text" class="form-control" name="loginPassword" id="loginPassword" placeholder="パスワード" required="required" pattern="^(?=.*?[a-z])(?=.*?[A-Z])(?=.*?\d)(?=.*?[!-/:-@[-`{-~])[!-~]{8,100}$">
<?php
}
?>
                                    </div>
                                    <hr>
                                    <input type="hidden" name="token" value="<?=_h(generateToken())?>">
                                    <input type="hidden" name="loginRequest" value="loginRequest">
                                    <button type="submit" class="btn btn-primary mx-2"><i class="fas fa-fw fa-sign-in-alt" aria-hidden="true"></i>ログイン</button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </nav>
        </header>
        <!-- /header -->
        <main class="main my-4">
            <div class="container-fulid">
<?php
if(count($contentsData)) { //コンテンツがある場合
?>
                <div class="row list" id="contentsRow">
<?php
    for($i = 0; $i < count($contentsData); $i++) {
        $content = $contentsData[$i];
        $contentStr = _h($content->co);
        $contentContents = _br($contentStr);
        $hashtags = '';
        if(!empty($content->ht)) {
            $hashtags = _hashtags(_cm(_h($content->ht)));
        }
        $postDateTime = dateConvertPost($content->wd, $content->dw, $content->dy, $content->dm, $content->dd, $content->tm);
        $lastActivityDate = dateConvert($content->la);
?>
                    <div class="xol-md-12 col-lg-4">
                        <div class="card">
<?php
        if(TOOT_MODE && !empty($content->im)) {
?>
                            <img class="card-img-top" src="<?=_h($content->im)?>" alt="<?=_h($content->ti)?>">
<?php
        }
?>
                            <div class="card-body">
                                <h3 class="card-title content_title"><?=_h($content->ti)?></h3>
                                <p class="card-text content_body"><?=$contentContents?></p>
                            </div>
                            <div class="card-footer">
<?php
        if(TOOT_MODE) {
?>
                                <p class="card-text"><span class="mr-2">ハッシュタグ:</span><span class="content_hashtags"><?=$hashtags?></span></p>
<?php
        }
?>
                                <p class="card-text"><span class="mr-2">キーワード:</span><span class="content_keywords"><?=_h($content->kw)?></span></p>
<?php
        if(TOOT_MODE && !empty($postDateTime)) {
?>
                                <p class="card-text text-right"><span class="mr-2">投稿日時:</span><?=_h($postDateTime)?></p>
<?php
        }
?>
                                <p class="card-text text-right"><i class="fas fa-fw fa-history mr-2" aria-hidden="true"></i><?=_h($lastActivityDate)?></p>
                            </div>
                        </div>
                    </div>
<?php
    }
?>
                </div>
<?php
}
else { //コンテンツがない場合
?>
            <p class="m-3"><i class="fas fa-fw fa-info-circle" aria-hidden="true"></i>コンテンツがありません。</p>
<?php
}
?>
            </div>
        </main>
<?php
    } //フロントページ ここまで
    else { //ログイン中
?>
<body class="dashboard" id="dashboard">
    <div id="wrapper">
        <!-- header -->
        <header class="header">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="./"><?=_h(GLOBAL_SITENAME)?></a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="ナビゲーションの切替">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbar">
                    <form class="form-inline ml-auto mr-2">
                        <i class="fas fa-fw fa-search" aria-hidden="true"></i><input class="form-control search" type="text" placeholder="検索" aria-label="検索">
                    </form>
                    <ul class="navbar-nav mr-5">
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle mr-5" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=_h(GLOBAL_AUHTOR)?>さん</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <form action="./" method="post">
                                    <a href="#" class="dropdown-item" id="navbarAccount"><i class="fas fa-fw fa-user" aria-hidden="true"></i>アカウント設定</a>
                                    <hr>
                                    <input type="hidden" name="token" value="<?=_h(generateToken())?>">
                                    <input type="hidden" name="logoutRequest" value="logoutRequest">
                                    <button type="submit" class="btn btn-info mx-2"><i class="fas fa-fw fa-sign-out-alt" aria-hidden="true"></i>ログアウト</button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </nav>
        </header>
        <!-- /header -->
        <main class="main my-4">
            <ul class="nav nav-tabs" id="dashboardTabs">
                <li class="nav-item"><a href="#" data-target="#dashboardCarousel" data-slide-to="0" class="nav-link active"><i class="fas fa-fw fa-file-signature" aria-hidden="true"></i>コンテンツ</a></li>
                <li class="nav-item"><a href="#" data-target="#dashboardCarousel" data-slide-to="1" class="nav-link"><i class="fas fa-fw fa-globe-americas" aria-hidden="true"></i>サイト設定</a></li>
                <li class="nav-item"><a href="#" data-target="#dashboardCarousel" data-slide-to="2" class="nav-link" id="tabAccount"><i class="fas fa-fw fa-user" aria-hidden="true"></i>アカウント設定</a></li>
                <li class="nav-item"><a href="#" data-target="#dashboardCarousel" data-slide-to="3" class="nav-link"><i class="fas fa-fw fa-database" aria-hidden="true"></i>バックアップ</a></li>
<?php
if(TOOT_MODE) { //Mastodon連携可能な場合
?>
                <li class="nav-item"><a href="#" data-target="#dashboardCarousel" data-slide-to="4" class="nav-link"><i class="fab fa-fw fa-mastodon" aria-hidden="true"></i>Mastodon連携</a></li>
<?php
}
?>
            </ul>
            <!-- .carousel -->
            <div id="dashboardCarousel" class="carousel dashboardCarousel slide" data-interval="false" data-wrap="false">
                <!-- .carousel-inner -->
                <div class="carousel-inner">
                    <!-- contents -->
                    <div class="carousel-item active">
                        <div class="container-fluid">
                            <div class="pb-2 mt-4 mb-2 border-bottom">
                                <h2><i class="fas fa-fw fa-file-signature" aria-hidden="true"></i>Contents Manage</h2>
                            </div>
                            <p>コンテンツを管理します。</p>
                            <p class="my-3">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#contentsNew"><i class="fas fa-fw fa-pen-nib" aria-hidden="true"></i>新規作成</button>
                            </p>
<?php
if(count($contentsData)) { //コンテンツがある場合
?>
                            <div class="my-4">
                                <div class="table-responsive">
                                    <table class="table table-sm table-striped table-bordered table-hover" id="contentsTable">
                                        <thead>
                                            <tr>
                                                <th>タイトル</th>
                                                <th>コンテンツ</th>
<?php
if(TOOT_MODE) { //Mastodon連携可能な場合
?>
                                                <th>ハッシュタグ</th>
                                                <th>画像パス</th>
                                                <th>投稿日時</th>
<?php
}
?>
                                                <th>キーワード</th>
                                                <th>最終更新日</th>
                                                <th>修正・削除</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list">
<?php
for($i = 0; $i < count($contentsData); $i++) {
    $content = $contentsData[$i];
    $contentStr = _h($content->co);
    $contentContents = _br($contentStr);
    $hashtags = '';
    if(!empty($content->ht)) {
        $hashtags = _hashtags(_cm(_h($content->ht)));
    }
    $postDateTime = dateConvertPost($content->wd, $content->dw, $content->dy, $content->dm, $content->dd, $content->tm);
    $lastActivityDate = dateConvert($content->la);
?>
                                            <tr>
                                                <td class="content_title"><?=_h($content->ti)?></td>
                                                <td class="content_body"><?=$contentContents?></td>
<?php
if(TOOT_MODE) { //Mastodon連携可能な場合
?>
                                                <td class="content_hashtags"><?=$hashtags?></td>
                                                <td><?=_h($content->im)?></td>
                                                <td><?=_h($postDateTime)?></td>
<?php
}
?>
                                                <td class="content_keywords"><?=_h($content->kw)?></td>
                                                <td><?=_h($lastActivityDate)?></td>
                                                <td><button type="button" class="btn btn-primary contentsUpdate_button" data-contentid="<?=_h($i)?>" data-toggle="modal" data-target="#contentsUpdate"><i class="fas fa-fw fa-pen" aria-hidden="true"></i>修正</button><button type="button" class="btn btn-warning ml-3 contentsDelete_button" data-contentid="<?=_h($i)?>" data-toggle="modal" data-target="#contentsDelete"><i class="fas fa-fw fa-eraser" aria-hidden="true"></i>削除</button></td>
                                            </tr>
<?php
}
?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
<?php
}
else { //コンテンツがない場合
?>
                            <p class="my-4"><i class="fas fa-fw fa-info-circle" aria-hidden="true"></i>まだコンテンツがありません。「新規作成」ボタンから、あなただけのコンテンツを作成しましょう！</p>
<?php
}
?>
                        </div>
                        <div class="dataField hidden">
                            <div class="data" id="dataContents" data-contents='<?=_h(_q(CONTENTS_DATA))?>'></div>
                            <div class="data" id="dataTootMode" data-tootmode='<?=_h(_q(TOOT_MODE))?>'></div>
                            <div class="data" id="dataWeek" data-week='<?=_h(_q(_je(WEEK)))?>'></div>
                            <div class="data" id="dataWeekDate" data-weekdate='<?=_h(_q(_je(WEEK_DATE)))?>'></div>
                        </div>
                    </div>
                    <!-- /contents -->
                    <!-- site -->
                    <div class="carousel-item">
                        <div class="container-fluid">
                            <div class="pb-2 mt-4 mb-2 border-bottom">
                                <h2><i class="fas fa-fw fa-sitemap" aria-hidden="true"></i>Site Settings</h2>
                            </div>
                            <p>サイトに関する設定を行います。</p>
                            <form action="./" method="post">
                                <h3 class="mt-4 mb-3">サイト設定</h3>
                                <div class="form-group row">
                                    <label for="siteSiteName" class="col-md-2 col-form-label" data-toggle="tooltip" title="Webサイトの名前です。"><i class="fas fa-fw fa-file-signature" aria-hidden="true"></i>サイト名<span class="badge badge-warning">必須</span></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="siteSiteName" id="siteSiteName" placeholder="<?=_h(GLOBAL_SITENAME)?>" value="<?=_h(GLOBAL_SITENAME)?>" required="required">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="siteDescription" class="col-md-2 col-form-label" data-toggle="tooltip" title="Webサイトの説明・キャッチフレーズです。titleタグやmetaタグのdescriptionに使用します。"><i class="fas fa-fw fa-pen-fancy" aria-hidden="true"></i>説明</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="siteDescription" id="siteDescription" placeholder="<?=_h(GLOBAL_DESCRIPTION)?>" value="<?=_h(GLOBAL_DESCRIPTION)?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="siteThemeColor" class="col-md-2 col-form-label" data-toggle="tooltip" title="Webサイトのイメージカラーです。"><i class="fas fa-fw fa-palette" aria-hidden="true"></i>テーマカラー</label>
                                    <div class="col-md-10">
                                        <input type="color" class="form-control" name="siteThemeColor" id="siteThemeColor" value="<?=_h(GLOBAL_THEME_COLOR)?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="siteCRYear" class="col-md-2 col-form-label" data-toggle="tooltip" title="Webサイトの発行年数です。コピーライトの表示に使います。"><i class="fas fa-fw fa-calendar" aria-hidden="true"></i>年<span class="badge badge-warning">必須</span></label>
                                    <div class="col-md-10">
                                        <input type="number" class="form-control" size="4" name="siteCRYear" id="siteCRYear" placeholder="<?=_h(GLOBAL_COPYRIGHT_YEAR)?>" value="<?=_h(GLOBAL_COPYRIGHT_YEAR)?>" required="required">
                                    </div>
                                </div>
                                <h3 class="mt-4 mb-3">OGP設定</h3>
                                <div class="form-group row">
                                    <label for="siteOGPTUserID" class="col-md-2 col-form-label" data-toggle="tooltip" title="OGPに設定するTwitterアカウントのユーザIDを入力してください。"><i class="fab fa-fw fa-twitter" aria-hidden="true"></i>TwitterユーザID</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="siteOGPTUserID" id="siteOGPTUserID" placeholder="<?=_h(GLOBAL_OGP_TWITTER_ACCOUNT)?>" value="<?=_h(GLOBAL_OGP_TWITTER_ACCOUNT)?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="siteOGPImage" class="col-md-2 col-form-label" data-toggle="tooltip" title="OGPに設定する画像のURLを指定してください。相対パスではなく、絶対パスで指定してください。"><i class="fas fa-fw fa-image" aria-hidden="true"></i>OGP画像</label>
                                    <div class="col-md-10">
                                        <input type="url" class="form-control" name="siteOGPImage" id="siteOGPImage" placeholder="<?=_h(GLOBAL_OGP_IMAGE)?>" value="<?=_h(GLOBAL_OGP_IMAGE)?>">
                                        <small class="form-text text-muted">相対パスではなく、絶対パスで指定してください。</small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="siteOGPURL" class="col-md-2 col-form-label" data-toggle="tooltip" title="OGPに設定するWebサイトのURLを指定してください。相対パスではなく、絶対パスで指定してください。"><i class="fas fa-fw fa-link" aria-hidden="true"></i>URL</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="siteOGPURL" id="siteOGPURL" placeholder="<?=_h(GLOBAL_OGP_URL)?>" value="<?=_h(GLOBAL_OGP_URL)?>">
                                        <small class="form-text text-muted">相対パスではなく、絶対パスで指定してください。</small>
                                    </div>
                                </div>
                                <input type="hidden" name="token" value="<?=_h(generateToken())?>">
                                <input type="hidden" name="siteRequest" value="siteRequest">
                                <button type="submit" class="btn btn-success"><i class="fas fa-fw fa-sync-alt" aria-hidden="true"></i>更新</button>
                            </form>
                        </div>
                    </div>
                    <!-- /site -->
                    <!-- account -->
                    <div class="carousel-item">
                        <div class="container-fluid">
                            <div class="pb-2 mt-4 mb-2 border-bottom">
                                <h2><i class="fas fa-fw fa-user" aria-hidden="true"></i>Account Settings</h2>
                            </div>
                            <p>アカウントに関する設定を行います。</p>
                            <form action="./" method="post">
                                <h3 class="mt-4 mb-3">ユーザ設定</h3>
                                <div class="form-group row">
                                    <label for="accountUserID" class="col-md-2 col-form-label" data-toggle="tooltip" title="管理画面ログイン時に使用します。3文字以上100文字以下で、半角英数字と記号を組み合わせたものを設定してください。"><i class="fas fa-fw fa-id-badge" aria-hidden="true"></i>ユーザID<span class="badge badge-warning">必須</span></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="accountUserID" id="accountUserID" placeholder="<?=_h(GLOBAL_USER_ID)?>" value="<?=_h(GLOBAL_USER_ID)?>" required="required" pattern="^[a-zA-Z\d]{3,100}$">
                                        <small class="form-text text-muted">3文字以上100文字以下の半角英数字で入力してください。</small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="accountUserName" class="col-md-2 col-form-label" data-toggle="tooltip" title="ログインした際の表示や各記事、フッタのコピーライト表示の著者情報として表示します。空欄の場合、ユーザIDを使用します。"><i class="fas fa-fw fa-user" aria-hidden="true"></i>ユーザ名</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="accountUserName" id="accountUserName" placeholder="<?=_h(GLOBAL_AUHTOR)?>" value="<?=_h(GLOBAL_AUHTOR)?>">
                                        <small class="form-text text-muted">空欄の場合、ユーザIDをユーザ名として使用します。</small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="accountUserSite" class="col-md-2 col-form-label" data-toggle="tooltip" title="フッタのコピーライト表示に付けるリンクを設定します。"><i class="fas fa-fw fa-link" aria-hidden="true"></i>ユーザのサイト</label>
                                    <div class="col-md-10">
                                        <input type="url" class="form-control" name="accountUserSite" id="accountUserSite" placeholder="<?=_h(GLOBAL_AUHTOR_URL)?>" value="<?=_h(GLOBAL_AUHTOR_URL)?>">
                                    </div>
                                </div>
                                <h3 class="mt-4 mb-3">パスワード変更</h3>
                                <div class="form-group row">
                                    <label for="accountNowPassword" class="col-md-2 col-form-label" data-toggle="tooltip" title="パスワード変更のために、現在のパスワードを確認します。現在のパスワードを入力してください。"><i class="fas fa-fw fa-unlock" aria-hidden="true"></i>現在のパスワード</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="accountNowPassword" id="accountNowPassword" placeholder="現在のパスワード">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="accountNewPassword" class="col-md-2 col-form-label" data-toggle="tooltip" title="変更したい新しいパスワードを入力してください。"><i class="fas fa-fw fa-key" aria-hidden="true"></i>新しいパスワード</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="accountNewPassword" id="accountNewPassword" placeholder="新しいパスワード" pattern="(^(?=.*?[a-z])(?=.*?[A-Z])(?=.*?\d)(?=.*?[!-/:-@[-`{-~])[!-~]{8,100}$|^$)">
                                        <small class="form-text text-muted">8文字以上100文字以下で、半角英数字と記号を組み合わせてください。</small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="accountConfirmPassword" class="col-md-2 col-form-label" data-toggle="tooltip" title="確認のため、もう一度新しいパスワードを入力してください。"><i class="fas fa-fw fa-key" aria-hidden="true"></i>新しいパスワード(確認)</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="accountConfirmPassword" id="accountConfirmPassword" placeholder="新しいパスワード(確認)" pattern="(^(?=.*?[a-z])(?=.*?[A-Z])(?=.*?\d)(?=.*?[!-/:-@[-`{-~])[!-~]{8,100}$|^$)">
                                    </div>
                                </div>
                                <input type="hidden" name="token" value="<?=_h(generateToken())?>">
                                <input type="hidden" name="accountRequest" value="accountRequest">
                                <button type="submit" class="btn btn-success"><i class="fas fa-fw fa-sync-alt" aria-hidden="true"></i>更新</button>
                            </form>
                        </div>
                    </div>
                    <!-- /account -->
                    <!-- backup -->
                    <div class="carousel-item">
                        <div class="container-fluid">
                            <div class="pb-2 mt-4 mb-2 border-bottom">
                                <h2><i class="fas fa-fw fa-database" aria-hidden="true"></i>Backup</h2>
                            </div>
                            <p>サイトのデータをバックアップします。</p>
                            <p class="mb-3">下記の「バックアップ」ボタンを押してダウンロードを実行してください。</p>
                            <form action="./" method="get" class="mb-2">
                                <input type="hidden" name="token" value="<?=_h(generateToken())?>">
                                <input type="hidden" name="backupRequest" value="backupRequest">
                                <button type="submit" class="btn btn-success"><i class="fas fa-fw fa-download" aria-hidden="true"></i>バックアップ</button>
                            </form>
<?php
if(TOOT_MODE) { //Mastodon連携可能な場合
?>
                            <form action="./" method="get">
                                <input type="hidden" name="token" value="<?=_h(generateToken())?>">
                                <input type="hidden" name="backupMastodonRequest" value="backupMastodonRequest">
                                <button type="submit" class="btn btn-success"><i class="fas fa-fw fa-download" aria-hidden="true"></i>バックアップ(Mastodon連携)</button>
                            </form>
<?php
}
?>
                        </div>
                    </div>
                    <!-- /backup -->
<?php
if(TOOT_MODE) { //Mastodon連携可能な場合
?>
                    <!-- mastodon -->
                    <div class="carousel-item">
                        <div class="container-fluid">
                            <div class="pb-2 mt-4 mb-2 border-bottom">
                                <h2><i class="fab fa-fw fa-mastodon" aria-hidden="true"></i>Mastodone Bot Settings</h2>
                            </div>
                            <p>Mastodon bot連携するための設定を行います。</p>
                            <form action="./" method="post">
                                <h3 class="mt-4 mb-3">インスタンス設定</h3>
                                <div class="form-group row">
                                    <label for="mastodonInstance" class="col-md-2 col-form-label" data-toggle="tooltip" title="bot用アカウントを作成したインスタンスを指定してください。記述はドメインのみ(「https://」部分は不要)です。"><i class="fas fa-fw fa-server" aria-hidden="true"></i>インスタンス<span class="badge badge-warning">必須</span></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="mastodonInstance" id="mastodonInstance" placeholder="mstdn.jp" value="<?=_h(GLOBAL_INSTANCE)?>" required="required">
                                    </div>
                                </div>
                                <h3 class="mt-4 mb-3">アカウント設定</h3>
                                <div class="form-group row">
                                    <label for="mastodonClientID" class="col-md-2 col-form-label" data-toggle="tooltip" title="bot用アカウントの設定で作成した「クライアントキー」を入力してください。"><i class="fas fa-fw fa-id-card" aria-hidden="true"></i>クライアントキー<span class="badge badge-warning">必須</span></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="mastodonClientID" id="mastodonClientID" value="<?=_h(GLOBAL_CLIENT_KEY)?>" required="required">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="mastodonClientSecret" class="col-md-2 col-form-label" data-toggle="tooltip" title="bot用アカウントの設定で作成した「クライアントシークレット」を入力してください。"><i class="fas fa-fw fa-lock" aria-hidden="true"></i>クライアントシークレット<span class="badge badge-warning">必須</span></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="mastodonClientSecret" id="mastodonClientSecret" value="<?=_h(GLOBAL_CLIENT_SECRET)?>" required="required">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="mastodonAccessToken" class="col-md-2 col-form-label" data-toggle="tooltip" title="bot用アカウントの設定で作成した「アクセストークン」を入力してください。"><i class="fas fa-fw fa-terminal" aria-hidden="true"></i>アクセストークン<span class="badge badge-warning">必須</span></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="mastodonAccessToken" id="mastodonAccessToken" value="<?=_h(GLOBAL_ACCESS_TOKEN)?>" required="required">
                                    </div>
                                </div>
                                <input type="hidden" name="token" value="<?=_h(generateToken())?>">
                                <input type="hidden" name="mastodonRequest" value="mastodonRequest">
                                <button type="submit" class="btn btn-success"><i class="fas fa-fw fa-sync-alt" aria-hidden="true"></i>更新</button>
                            </form>
                        </div>
                    </div>
                    <!-- /mastodon -->
<?php
}
?>
                </div>
                <!-- /.carousel-inner -->
            </div>
            <!-- /.carousel -->
        </main>

        <!-- new .modal -->
        <div class="modal fade" id="contentsNew" tabindex="-1" role="dialog" aria-labelledby="contentsNewLabel">
            <div class="modal-dialog modal-lg" role="document">
                <form action="./" method="post">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="contentsNewLabel"><i class="fas fa-fw fa-pen-nib" aria-hidden="true"></i>新規作成</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                                <i class="fas fa-fw fa-times" aria-hidden="true"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="contentsNewTitle">タイトル</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="contentsNewTitle" id="contentsNewTitle">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="contentsNewContents">本文</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="contentsNewContents" id="contentsNewContents"></textarea>
                                </div>
                            </div>
<?php
if(TOOT_MODE) { //Mastodon連携可能な場合
?>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="contentsNewHashTags" data-toggle="tooltip" title="Mastodon投稿時に付けるハッシュタグを指定します。#なしで、カンマ区切りで指定してください。">ハッシュタグ</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="contentsNewHashTags" id="contentsNewHashTags">
                                    <small class="form-text text-muted">#なしで、カンマ区切りで指定してください。</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="contentsNewImgPath" data-toggle="tooltip" title="Mastodonの画像付きトゥート投稿時に付ける画像を指定します。このページのURLからの相対パスで指定してください。画像を付けない場合は空欄のままで構いません。">画像パス</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="contentsNewImgPath" id="contentsNewImgPath">
                                    <small class="form-text text-muted">このページのURLからの相対パスで指定してください。画像を付けない場合は空欄のままで構いません。</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="contentsNewDate" data-toggle="tooltip" title="Mastodonで日時指定投稿する場合に指定します。実際の投稿の指示はレンタルサーバの管理画面のcron設定から行ってください。ここで指定した日時が、cron設定で行った日時の前後5分以内であれば条件に一致したと判定します。もし日時指定したコンテンツとしていないコンテンツが混在する場合、日時指定なしのコンテンツよりもここで日時指定を行ったコンテンツを優先して投稿を行います。">投稿予約日時</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <div class="custom-control custom-radio">
                                            <input id="contentsNewWeekDateNo" name="contentsNewWeekDate" type="radio" class="custom-control-input" value="<?=WEEK_DATE['no']?>" checked="checked">
                                            <label class="custom-control-label" for="contentsNewWeekDateNo"><?=WEEK_DATE['no']?></label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input id="contentsNewWeekDateWeek" name="contentsNewWeekDate" type="radio" class="custom-control-input" value="<?=WEEK_DATE['we']?>">
                                            <label class="custom-control-label" for="contentsNewWeekDateWeek"><?=WEEK_DATE['we']?></label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input id="contentsNewWeekDateDate" name="contentsNewWeekDate" type="radio" class="custom-control-input" value="<?=WEEK_DATE['dt']?>">
                                            <label class="custom-control-label" for="contentsNewWeekDateDate"><?=WEEK_DATE['dt']?></label>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <div class="form-check form-check-inline form_week my-3">
<?php
    foreach(WEEK as $index => $week) {
?>
                                            <input class="form-check-input" type="checkbox" name="contentsNewWeek[]" id="contentsNewWeek<?=_h($index)?>" value="<?=_h($index)?>" disabled="disabled"><label class="form-check-label mr-2" for="contentsNewWeek<?=_h($index)?>"><?=_h($week)?></label>
<?php
    }
?>
                                        </div>
                                    </div>
                                    <div class="input-group form_date">
                                        <input type="number" class="form-control" name="contentsNewDateYear" id="contentsNewDateYear" min="1970" disabled="disabled">年
                                        <input type="number" class="form-control ml-sm-2" name="contentsNewDateMonth" id="contentsNewDateMonth" max="12" min="1" disabled="disabled">月
                                        <input type="number" class="form-control ml-sm-2" name="contentsNewDateDay" id="contentsNewDateDay" max="31" min="1" disabled="disabled">日
                                        <input type="time" class="form-control ml-sm-2" name="contentsNewTime" id="contentsNewTime" disabled="disabled">
                                    </div>
                                    <small class="form-text text-muted">実際の投稿の指示はレンタルサーバの管理画面の<code>cron</code>設定から行ってください。</small>
                                </div>
                            </div>
<?php
}
?>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="contentsNewKeywords" data-toggle="tooltip" title="コンテンツが大量にある場合、検索ボックスで検索するためのキーワードを指定します。">キーワード</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="contentsNewKeywords" id="contentsNewKeywords">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="token" value="<?=_h(generateToken())?>">
                            <input type="hidden" name="contentsNewRequest" value="contentsNewRequest">
                            <button type="submit" class="btn btn-success" id="contentsNewRequest_button"><i class="fas fa-fw fa-upload" aria-hidden="true"></i>公開</button>
                        </div><!-- /.modal-footer -->
                    </div><!-- /.modal-content -->
                </form>
            </div><!-- /.modal-dialog -->
        </div><!-- /new .modal -->

        <!-- update .modal -->
        <div class="modal fade" id="contentsUpdate" tabindex="-1" role="dialog" aria-labelledby="contentsUpdateLabel">
            <div class="modal-dialog modal-lg" role="document">
                <form action="./" method="post">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="contentsUpdateLabel"><i class="fas fa-fw fa-pen-nib" aria-hidden="true"></i>修正</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                                <i class="fas fa-fw fa-times" aria-hidden="true"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="contentsUpdateTitle">タイトル</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="contentsUpdateTitle" id="contentsUpdateTitle">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="contentsUpdateContents">本文</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="contentsUpdateContents" id="contentsUpdateContents"></textarea>
                                </div>
                            </div>
<?php
if(TOOT_MODE) { //Mastodon連携可能な場合
?>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="contentsUpdateHashTags" data-toggle="tooltip" title="Mastodon投稿時に付けるハッシュタグを指定します。#なしで、カンマ区切りで指定してください。">ハッシュタグ</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="contentsUpdateHashTags" id="contentsUpdateHashTags">
                                    <small class="form-text text-muted">#なしで、カンマ区切りで指定してください。</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="contentsUpdateImgPath" data-toggle="tooltip" title="Mastodonの画像付きトゥート投稿時に付ける画像を指定します。このページのURLからの相対パスで指定してください。画像を付けない場合は空欄のままで構いません。">画像パス</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="contentsUpdateImgPath" id="contentsUpdateImgPath">
                                    <small class="form-text text-muted">このページのURLからの相対パスで指定してください。画像を付けない場合は空欄のままで構いません。</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="contentsUpdateDate" data-toggle="tooltip" title="Mastodonで日時指定投稿する場合に指定します。実際の投稿の指示はレンタルサーバの管理画面のcron設定から行ってください。ここで指定した日時が、cron設定で行った日時の前後5分以内であれば条件に一致したと判定します。もし日時指定したコンテンツとしていないコンテンツが混在する場合、日時指定なしのコンテンツよりもここで日時指定を行ったコンテンツを優先して投稿を行います。">投稿予約日時</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <div class="custom-control custom-radio">
                                            <input id="contentsUpdateWeekDateNo" name="contentsUpdateWeekDate" type="radio" class="custom-control-input" value="<?=WEEK_DATE['no']?>" checked="checked">
                                            <label class="custom-control-label" for="contentsUpdateWeekDateNo"><?=WEEK_DATE['no']?></label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input id="contentsUpdateWeekDateWeek" name="contentsUpdateWeekDate" type="radio" class="custom-control-input" value="<?=WEEK_DATE['we']?>">
                                            <label class="custom-control-label" for="contentsUpdateWeekDateWeek"><?=WEEK_DATE['we']?></label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input id="contentsUpdateWeekDateDate" name="contentsUpdateWeekDate" type="radio" class="custom-control-input" value="<?=WEEK_DATE['dt']?>">
                                            <label class="custom-control-label" for="contentsUpdateWeekDateDate"><?=WEEK_DATE['dt']?></label>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <div class="form-check form-check-inline form_week my-3">
<?php
    foreach(WEEK as $index => $week) {
?>
                                            <input class="form-check-input" type="checkbox" name="contentsUpdateWeek[]" id="contentsUpdateWeek<?=_h($index)?>" value="<?=_h($index)?>" disabled="disabled"><label class="form-check-label mr-2" for="contentsUpdateWeek<?=_h($index)?>"><?=_h($week)?></label>
<?php
    }
?>
                                        </div>
                                    </div>
                                    <div class="input-group form_date">
                                        <input type="number" class="form-control" name="contentsUpdateDateYear" id="contentsUpdateDateYear" min="1970" disabled="disabled">年
                                        <input type="number" class="form-control ml-sm-2" name="contentsUpdateDateMonth" id="contentsUpdateDateMonth" max="12" min="1" disabled="disabled">月
                                        <input type="number" class="form-control ml-sm-2" name="contentsUpdateDateDay" id="contentsUpdateDateDay" max="31" min="1" disabled="disabled">日
                                        <input type="time" class="form-control ml-sm-2" name="contentsUpdateTime" id="contentsUpdateTime" disabled="disabled">
                                    </div>
                                    <small class="form-text text-muted">実際の投稿の指示はレンタルサーバの管理画面の<code>cron</code>設定から行ってください。</small>
                                </div>
                            </div>
<?php
}
?>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="contentsUpdateKeywords" data-toggle="tooltip" title="コンテンツが大量にある場合、検索ボックスで検索するためのキーワードを指定します。">キーワード</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="contentsUpdateKeywords" id="contentsUpdateKeywords">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="contentsUpdateID" id="contentsUpdateID">
                            <input type="hidden" name="token" value="<?=_h(generateToken())?>">
                            <input type="hidden" name="contentsUpdateRequest" value="contentsUpdateRequest">
                            <button type="submit" class="btn btn-success" id="contentsUpdateRequest_button"><i class="fas fa-fw fa-upload" aria-hidden="true"></i>更新</button>
                        </div><!-- /.modal-footer -->
                    </div><!-- /.modal-content -->
                </form>
            </div><!-- /.modal-dialog -->
        </div><!-- /update .modal -->

        <!-- delete .modal -->
        <div class="modal fade" id="contentsDelete" tabindex="-1" role="dialog" aria-labelledby="contentsDeleteLabel">
            <div class="modal-dialog modal-lg" role="document">
                <form action="./" method="post">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="contentsDeleteLabel"><i class="fas fa-fw fa-eraser" aria-hidden="true"></i>削除</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                                <i class="fas fa-fw fa-times" aria-hidden="true"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="contentsDeleteTitle">タイトル</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control-plaintext" name="contentsDeleteTitle" id="contentsDeleteTitle" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <p>削除したコンテンツは二度と元には戻せません！本当によろしいですか？</p>
                            <input type="hidden" name="contentsDeleteID" id="contentsDeleteID">
                            <input type="hidden" name="token" value="<?=_h(generateToken())?>">
                            <input type="hidden" name="contentsDeleteRequest" value="contentsDeleteRequest">
                            <button type="submit" class="btn btn-danger"><i class="fas fa-fw fa-eraser" aria-hidden="true"></i>削除</button>
                        </div><!-- /.modal-footer -->
                    </div><!-- /.modal-content -->
                </form>
            </div><!-- /.modal-dialog -->
        </div><!-- /delete .modal -->

<?php
    } //ログイン中 ここまで
?>
        <div class="returnPageTop"><i class="fas fa-fw fa-arrow-up" aria-hidden="true"></i></div>
        <!-- footer -->
        <footer class="footer">
            <small class="copyRight">Copyright © <?=_h($appCopyRightYear)?> <a href="<?=_h(GLOBAL_AUHTOR_URL)?>"><?=_h(GLOBAL_AUHTOR)?></a> All Right Reserved.</small>
            <small class="copyRight">Powered by <a href="<?=_h(GLOBAL_APP_URL)?>"><?=_h(GLOBAL_APP_NAME)?> (ver.<?=_h(GLOBAL_APP_VERSION)?>)</a></small>
        </footer>
        <!-- /footer -->
<!-- 条件分岐はここまで、scriptとbody・html閉じタグは共通に -->
<?php
}
?>
    </div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bowser/1.9.4/bowser.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
<script>
<!-- KATSURAGI_JS -->
</script>
</body>
</html>