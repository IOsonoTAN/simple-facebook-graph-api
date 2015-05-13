## Simple-facebook-graph-api for PHP
It's php simple script for calling to Facebook Graph API.

### Features
- The script is clean and simple to learning.
- API references like a Facebook graph API. (https://developers.facebook.com/docs/graph-api)
- Response to JSON or Array.

### How to use (You can see the test.php)
- Basic
~~~php
require('facebook-library.php');
$access_token = 'Enter your access token: User token or Page token';
$facebook = new Facebook($access_token);
~~~

- GET method
~~~php
$results = $facebook->api('me')
                    ->get('json');
print_r($results);
~~~

- POST method
~~~php
$datas = array(
  'message' => 'Post by Simple Facebook Graph API, return JSON'
);
$results = $facebook->api('feed')
                    ->post($datas, 'json');
print_r($results);
~~~

### Support or Contact
If you have any problems, Contact to me: im@tzv.me (Krissada Boontrigratn)