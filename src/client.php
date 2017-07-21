<?PHP

namespace richbarrett\crispsdk;

class client {
  
  var $url = 'https://api.crisp.chat/v1';
  var $request_timeout = 10;
  var $headers = array();
  
  function __construct() {
    
    $this->headers['Content-Type'] = 'application/json';
        
  }
  
  function authenticate($identifier, $key) {
    $this->headers['Authorization'] = 'Basic '.base64_encode($identifier.':'.$key);
  }
  
  function sendRequest($method, $uri, $payload='', $headers=array()) {
    
    
    $headers = array_merge($headers, $this->headers);
    $url = rtrim($this->url,'/').'/'.ltrim($uri,'/');
    
    $method = strtoupper($method);
    if(!in_array($method, [ 'GET','POST','PUT','PATCH' ])) throw new \Exception('Unknown method "'.$method.'"');
    
    // Create the request and set some basic parameters
    $request = \Httpful\Request::$method($url);
    $request->timeoutIn($this->request_timeout);
    $request->expectsJson(); // Always JSON from Crisp API
    if(count($headers) > 0) $request->addHeaders($headers);
    
    if($method != 'GET') {
      if(is_array($payload)) $payload = json_encode($payload);
      if(strlen($payload) > 0) $request->body($payload);
    }
    
    //print_r($request);exit;
    
    $response = $request->send();
    $ret['code'] = $response->code;
    $ret['body'] = $response->body->data;
    $ret['reason'] = $response->body->reason;
    
    if($response->body->error) {
      $ret['error'] = true;
    }
    
    $ret['raw'] = $response;
    
    return $ret;
    
  }

  
}

?>