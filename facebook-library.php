<?php

/**
 * Simple Facebook Graph API
 * Created by Krissada Boontrigratn
 * Website http://tzv.me
 * Email im@tzv.me
 */

class Facebook {

  /**
   * Default variables
   */
  protected $url = 'https://graph.facebook.com/v2.3';
  protected $filter = 'toplevel'; /* toplevel or stream */
  protected $limit = 10;
  private $timeout = 300;

  public function __construct($access_token = ''){
    $this->access_token = $access_token;
  }

  /**
   * Calling functions
   */
  private function generateRequestURL(){
    $this->url_request = $this->url.$this->api.'?'.http_build_query($this);
    return $this;
  }

  public function api($api){
    if(substr($api, 0, 1) == '/'):
      $this->api = $api;
    else:
      $this->api = '/'.$api;
    endif;
    return $this;
  }

  public function get($response_format = ''){
    $this->generateRequestURL();
    if($response_format == 'json'):
      return $this->doRequest();
    endif;
    return json_decode($this->doRequest());
  }

  public function post($datas = array(), $response_format = ''){
    $this->generateRequestURL();
    if($response_format == 'json'):
      return $this->doRequest('post', $datas);
    endif;
    return json_decode($this->doRequest('post', $datas));
  }

  /**
   * Request to Facebook API
   */
  private function doRequest($method = 'get', $datas = array()){
    $curl = curl_init();
            curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_URL, $this->url_request);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt($curl, CURLOPT_TIMEOUT, $this->timeout);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLINFO_HEADER_OUT, true);
            curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.66 Safari/537.36");

            if($method == 'post'):
              curl_setopt($curl, CURLOPT_POST, count($datas));
              curl_setopt($curl, CURLOPT_POSTFIELDS, '&'.http_build_query($datas));
            endif;

    $results = curl_exec($curl);
    $get_info = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    return $results;
  }

  /**
   * Methods
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