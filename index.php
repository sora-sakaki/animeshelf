<?php
require_once dirname(__FILE__).'/lib/Twitter.php';
require_once dirname(__FILE__).'/config.php';

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

