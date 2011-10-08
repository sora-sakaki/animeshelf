<?php
require_once dirname(__FILE__).'/lib/Twitter.php';
require_once dirname(__FILE__).'/config.php';

session_start();
// debug code
if($isUseDummyUser === true) {
  $_SESSION['oauthToken'] = array('screen_name' => $dummyUser);
}


if(isset($_SESSION['oauthToken']['screen_name'])){
  // data initialize
  $searchKey = $_GET['searchKey'];
  if ($searchKey === '') {
    die('please input search key');
  }

  // mysql connection
  $link = mysql_connect($mysql_server, $mysql_user, $mysql_pass);
  if (!$link) {
    die('connecting database-server is failed.');
  }
  $db_selected = mysql_select_db($mysql_database, $link);
  if (!$db_selected) {
    die('selecting database is failed.');
  }

  $query = 'select * from anime_title where name like "%'.$searchKey.'%"';
  $result = mysql_query($query);
  
  $query_result = array();
  $i = 0;
  while ($row = mysql_fetch_assoc($result)) {
    $query_result[$i] = array();
    $query_result[$i]['title'] = $row;
    $query_result[$i]['story'] = array();
    $story_query = 'select sub_title,story_num from anime_story where anime_id='.$row['id'].'';
    $story_result = mysql_query($story_query);
    $j = 0;
    while ($story_row = mysql_fetch_assoc($story_result)) {
      $query_result[$i]['story'][$j] = $story_row;
      $j++;
    }
    $i++;
  }
  
  mysql_close($link);

  $response = $query_result;
  /*$response = array();
  $response['result'] = $query_result;
  $response['sql'] = $query;
*/

  // response
  print(json_encode($response));
} else {
    header("HTTP/1.1 301");
    header("Location: {$rootURL}/login.php");
}

