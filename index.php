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
if(isset($_SESSION['oauthToken']['screen_name'])){
  $smarty->assign('userName', $_SESSION['oauthToken']['screen_name']);
  $smarty->display('index_login.tpl');
} else {
  try {
      $twitter = new Twitter();
      $oauth = $twitter->oAuth($consumer_key, $consumer_secret);
      $requestToken = $oauth->getRequestToken();
      $url = $oauth->getAuthorizeUrl($requestToken);
      $_SESSION['twitter'] = $twitter;
      $_SESSION['oauth'] = $oauth;
  } catch (Exception $e) {
      echo $e;
  }
  $smarty->assign('loginURL',$url);
  $smarty->display('index_notlogin.tpl');
}

