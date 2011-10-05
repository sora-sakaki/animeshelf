<?php                                                                                        
require_once dirname(__FILE__).'/lib/Twitter.php';
require_once dirname(__FILE__).'/config.php';

session_start();
$_SESSION = array();

if (isset($_COOKIE[session_name()])) {
  setcookie(session_name(), '', time()-42000, '/');
}

session_destroy();

header("HTTP/1.1 301");
header("Location: {$rootURL}");

