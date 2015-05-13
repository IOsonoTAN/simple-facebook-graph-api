## Simple-facebook-graph-api for PHP
It's php simple script for calling to Facebook Graph API.

### Features
- The script is clean and simple to learning.
- Alias like a references in Facebook Graph API.
- Return to JSON or Object.

### How to use

- GET method
~~~php
$results = $facebook->api('me')
                    ->get();
print_r($results);
~~~

- POST method
~~~php
$results = $facebook->api('me')
                    ->get();
print_r($results);
~~~

### Support or Contact
If you have any problems, Contact im@tzv.me)