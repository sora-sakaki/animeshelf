<?php
require_once dirname(__FILE__).'/lib/Twitter.php';

// twitter information
$consumer_key = 'niJ3erGVJu0wFlr8L6Fkg';
$consumer_secret = '2zybw6Fclw1bW3jWSCyNUawkDJtFFWGCeFcQgGrjUY';

try {
    $twitter = new Twitter();
    $oauth = $twitter->oAuth($consumer_key, $consumer_secret);
    $requestToken = $oauth->getRequestToken();
    $url = $oauth->getAuthorizeUrl($requestToken);
    print($url);
} catch (Exception $e) {
    echo $e;
}

