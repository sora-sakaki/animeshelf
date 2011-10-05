<?php
require_once dirname(__FILE__).'/lib/Twitter.php';
require_once dirname(__FILE__).'/lib/smarty/Smarty.class.php';
require_once dirname(__FILE__).'/config.php';

$smarty = new Smarty();

$smarty->template_dir = dirname(__FILE__).'/templates/';
$smarty->compile_dir = dirname(__FILE__).'/templates_c/';
$smarty->config_dir = dirname(__FILE__).'/configs/';
$smarty->cache_dir = dirname(__FILE__).'/cache/';

$smarty->display('template.html');
/*
session_start();
if(isset($_SESSION['userName'])){
    print('welcome : '.$_SESSION['userName']);
    print('<br>');
} else {
    print('not logining');
    print('<br>');
}

try {
    $twitter = new Twitter();
    $oauth = $twitter->oAuth($consumer_key, $consumer_secret);
    $requestToken = $oauth->getRequestToken();
    $url = $oauth->getAuthorizeUrl($requestToken);
    print('<a href="'.$url.'"><img src="image/sign-in-with-twitter-l.png"></a>');
    $_SESSION['twitter'] = $twitter;
    $_SESSION['oauth'] = $oauth;
} catch (Exception $e) {
    echo $e;
}

*/

