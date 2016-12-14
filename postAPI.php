<?php

require('src/GraphAPI.php');

try {
  $accessToken = 'Enter your access token: User token or Page token';
  $facebook = new GraphAPI($accessToken, 'https://graph.facebook.com', 'v2.8');

  /**
   * How to use POST
   */
  $data = array(
    'message' => 'Post by Simple Facebook Graph API, return JSON'
  );
  $result = $facebook->api('feed')
                     ->post($data, 'json');
  echo $result;
} catch(Exception $e) {
  echo $e->getMessage();
}