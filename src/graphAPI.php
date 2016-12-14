<?php

/**
 * Simple Facebook Graph API
 * Created by Krissada Boontrigratn
 * Website http://tzv.me
 * Email im@tzv.me
 */

class GraphAPI {

  public function __construct(
    $accessToken = '',
    $apiUrl = 'https://graph.facebook.com',
    $apiVersion = 'v2.8',
    $apiFilter = 'stream', /* should be 'stream' or 'toplevel' (default is 'stream') */
    $apiLimit = 10,
    $apiTimeout = 500
  ){
    if (!$accessToken) {
      throw new Exception('Missing argument 1 for GraphAPI ($access_token)');
    }
    $this->access_token = $accessToken;
    $this->filter = $apiFilter;
    $this->limit = $apiLimit;
    $this->timeout = $apiTimeout;
    $this->url = $this->mergeApiUrl($apiUrl, $apiVersion);
  }

  /**
   * Private methods
   */
  private function doRequest($method = 'get', $datas = array()){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_URL, $this->url_request);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, strtoupper($method));
    curl_setopt($curl, CURLOPT_TIMEOUT, $this->timeout);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLINFO_HEADER_OUT, true);
    curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.66 Safari/537.36");
    if($method === 'post'){
      curl_setopt($curl, CURLOPT_POST, count($datas));
      curl_setopt($curl, CURLOPT_POSTFIELDS, '&'.http_build_query($datas));
    }
    $results = curl_exec($curl);
    $get_info = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    return $results;
  }

  private function mergeApiUrl($apiUrl, $apiVersion) {
    $apiVersion = $this->mergeApiVersion($apiVersion);
    if(substr($apiUrl, -1) === '/'){
      return $apiUrl.$apiVersion;
    } else {
      return $apiUrl.'/'.$apiVersion;
    } 
  }

  private function mergeApiVersion($apiVersion) {
    if(substr($apiVersion, 0, 1) === 'v'){
      return $apiVersion;
    } else {
      return 'v'.$apiVersion;
    }
  }

  private function generateRequestURL(){
    $this->url_request = $this->url.$this->api.'?'.http_build_query($this);
    return $this;
  }

  public function api($api){
    if(substr($api, 0, 1) === '/'){
      $this->api = $api;
    } else {
      $this->api = '/'.$api;
    }
    return $this;
  }

  public function get($response_format = ''){
    $this->generateRequestURL();
    if($response_format === 'json'){
      return $this->doRequest();
    }
    return json_decode($this->doRequest());
  }

  public function getURL(){
    $this->generateRequestURL();
    return $this->url_request;
  }

  public function post($datas = array(), $response_format = ''){
    $this->generateRequestURL();
    if($response_format === 'json'){
      return $this->doRequest('post', $datas);
    }
    return json_decode($this->doRequest('post', $datas));
  }

  /**
   * Public methods like Facebook API
   */
  public function accessToken($accessToken){
    $this->access_token = $accessToken;
    return $this;
  }

  public function fields($fields){
    $this->fields = $fields;
    return $this;
  }

  public function since($time){
    $this->since = $time;
    return $this;
  }

  public function until($time){
    $this->until = $time;
    return $this;
  }

  public function filter($filter){
    $this->filter = $filter;
    return $this;
  }

  public function order($order){
    $this->order = $order;
    return $this;
  }

  public function offset($offset){
    $this->offset = $offset;
    return $this;
  }

  public function limit($limit){
    $this->limit = $limit;
    return $this;
  }

}