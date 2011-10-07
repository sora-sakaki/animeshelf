<?php
require_once dirname(__FILE__).'/lib/Twitter.php';

require_once dirname(__FILE__).'/lib/smarty/Smarty.class.php';
require_once dirname(__FILE__).'/config.php';

$smarty = new Smarty();

$smarty->template_dir = dirname(__FILE__).'/templates/';
$smarty->compile_dir = dirname(__FILE__).'/templates_c/';
$smarty->config_dir = dirname(__FILE__).'/configs/';
$smarty->cache_dir = dirname(__FILE__).'/cache/';

session_start();
// debug code
if($isUseDummyUser === true) {
  $_SESSION['oauthToken'] = array('screen_name' => $dummyUser);
}

if(isset($_SESSION['oauthToken']['screen_name'])){
  $smarty->assign('userName', $_SESSION['oauthToken']['screen_name']);
  $smarty->display('add_my_anime.tpl');
} else {
    header("HTTP/1.1 301");
    header("Location: {$rootURL}/login.php");
}

