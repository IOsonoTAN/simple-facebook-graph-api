## Simple-facebook-graph-api for PHP
It's php simple script for calling to Facebook Graph API.

### Features
- The script is clean and simple to learning.
- API references like a Facebook graph API. (https://developers.facebook.com/docs/graph-api)
- Response to JSON or Array.

### How to use (You can see the getAPI.php and postAPI.php)
#### Before use:
- You should have access token before. (user token or page token, related: https://github.com/IOsonoTAN/facebook-access-token)

- Basic
~~~php
require('src/GraphAPI.php');
$accessToken = 'Enter your access token: user token or page token';
$facebook = new GraphAPI($accessToken (require), $apiUrl (optional), $apiVersion (optional), $apiFilter (optional), $apiLimit (optional), $apiTimeout (optional));
~~~

- GET method
~~~php
$result = $facebook->api('me')
                   ->get('json');
print_r($result);
~~~

- POST method
~~~php
$data = array(
  'message' => 'Post by Simple Facebook Graph API, request to Facebook API and return JSON'
);
$result = $facebook->api('feed')
                   ->post($data, 'json');
print_r($result);
~~~

### Unit test by PHPUnit (https://phpunit.de)
~~~php
phpunit tests/src/graphAPI.php
~~~

### Support or Contact
If you have any problems, Contact me: im@tzv.me (Krissada Boontrigratn)
