<?php

function pr($object){
  echo '<pre>';
  print_r($object);
  echo '</pre>';
}

require('facebook-library.php');

$access_token = 'Enter your access token: User token or Page token';
$facebook = new Facebook($access_token);

/**
 * How to use GET
 */
$results = $facebook->api('me')
                    ->get();
pr($results);

/**
 * How to use POST
 */
$datas = array(
  'message' => 'Post by Simple Facebook Graph API, return JSON'
);
$results = $facebook->api('feed')
                    ->post($datas, 'json');
pr($results);