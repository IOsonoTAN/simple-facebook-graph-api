<?php

require('src/GraphAPI.php');

try {
  $accessToken = 'Enter your access token: User token or Page token';
  $facebook = new GraphAPI($accessToken, 'https://graph.facebook.com', 'v2.8');

  /**
   * How to use GET
   */
  $result = $facebook->api('me')
                     ->fields('first_name, last_name, email, birthday, gender, locale, languages, link, timezone, verified')
                     ->get('json');
  echo $result;
} catch(Exception $e) {
  echo $e->getMessage();
}