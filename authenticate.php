<?php
require_once dirname(__FILE__).'/lib/Twitter.php';
require_once dirname(__FILE__).'/config.php';

session_start();

$oauth_token = $_GET['oauth_token'];
$oauth_token_secret = $_GET['oauth_verifier'];


try {
    $twitter = new Twitter();
    $oauth = $twitter->oAuth($consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret);
    $statuses = $twitter->call('statuses/home_timeline');
    foreach ($statuses as $status) {
        echo $status['user']['name'].': ';
        echo $status['text'].PHP_EOL;
    }
} catch (Exception $e) {
    echo $e;
}

