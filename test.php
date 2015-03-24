<?php

function pr($object){
  echo '<pre>';
  print_r($object);
  echo '</pre>';
}

require('facebook-library.php');

$access_token = 'Enter you access token: User token or Page token';
$facebook = new Facebook($access_token);
$results = $facebook->api('me')
                    ->get();
pr($object);