<?PHP

namespace richbarrett\crispsdk;

class request {
  
  var $client;
  var $headers=array();
  var $payload = '';
  var $uri = '';
  var $method = 'GET';
  var $successful_http_code = array('200');
    
  function __construct($client) {
    $this->client = $client;
  }
  
  function send() {
        
    $response = $this->client->sendRequest($this->method, $this->uri, $this->payload, $this->headers);
    
    // Handle rate limiting or service being down
    if(in_array($response->code, [ 404, 429 ])) throw new \Exception('Response Code: '.$response->code);
    return $response;
  
  }
  
}

?>