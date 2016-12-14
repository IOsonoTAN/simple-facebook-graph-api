<?php
  
use PHPUnit\Framework\TestCase;
require('src/GraphAPI.php');

class graphAPITest extends TestCase {

  protected $accessToken = 'xxxxxxxxxxx';
  protected $testUrl = 'https://graph.facebook.com';
  protected $testUrlSlash = 'https://graph.facebook.com/';
  protected $testApiVersion = '2.7';

  public function testShouldBePerfectCaseReturnCorrectFormat() {
    $result = new GraphAPI($this->accessToken);

    $expect = new GraphAPI($this->accessToken);
    $expect->access_token = $this->accessToken; 
    $expect->filter = 'stream'; 
    $expect->limit = 10; 
    $expect->timeout = 500; 
    $expect->url = 'https://graph.facebook.com/v2.8';

    $this->assertEquals($expect, $result);
  }

  public function testShouldReturnCorrectByVersionArguments() {
    $result = new GraphAPI($this->accessToken, $this->testUrl, $this->testApiVersion);

    $this->assertEquals($this->testUrlSlash.'v'.$this->testApiVersion, $result->url);
  }

  public function testShouldReturnCorrectByVersionVArguments() {
    $result = new GraphAPI($this->accessToken, $this->testUrlSlash, 'v'.$this->testApiVersion);

    $this->assertEquals($this->testUrlSlash.'v'.$this->testApiVersion, $result->url);
  }

  public function testShouldReturnCorrectURL() {
    $api = new GraphAPI($this->accessToken, $this->testUrlSlash, $this->testApiVersion);
    $result = $api->getURL();
    
    $expectUrl = $this->testUrlSlash.'v'.$this->testApiVersion.'?access_token='.$this->accessToken.'&filter=stream&limit=10&timeout=500&url=https%3A%2F%2Fgraph.facebook.com%2Fv'.$this->testApiVersion;
    $this->assertEquals($expectUrl, $result);
  }

}