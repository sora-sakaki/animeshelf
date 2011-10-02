<?php
require_once dirname(__FILE__).'/lib/Twitter.php';
require_once dirname(__FILE__).'/config.php';

session_start();

if(isset($_SESSION['oauth']) == false) {
    print('error');
    die;
}

$twitter = $_SESSION['twitter'];
$oauth = $_SESSION['oauth'];

unset($_SESSION['twitter']);
unset($_SESSION['oauth']);

$oauth_token = $_GET['oauth_token'];
$oauth_verifier = $_GET['oauth_verifier'];

try {
    $token = $oauth->getAccessToken($oauth_verifier);
    $_SESSION['userName'] = $token['screen_name'];
    header("HTTP/1.1 301");
    header("Location: {$rootURL}");
} catch (Exception $e) {
    echo $e;
}

