<?PHP

namespace richbarrett\crispsdk;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/src/client.php';
require __DIR__ . '/src/request.php';

use richbarrett\crispsdk\client;
use richbarrett\crispsdk\request;


class crispsdk {
  
  var $client;
  
  function __construct() {
    $this->client = new client;
  }
  
  function authenticate($id,$key) {
    $this->client->authenticate($id, $key);
  }
  
  function listWebsites() {
    
    $request = new request($this->client);
    $request->uri = '/user/account/websites';
    $response = $request->send();
    
    return $request->send();
    
  }
  
  function findUserByEmail($website_id, $email) {
    
    $request = new request($this->client);
    $request->uri = '/website/'.$website_id.'/people/profiles/1?search_filter=[{"model":"people","criterion":"email","operator":"eq","query":["'.$email.'"]}]&search_operator=and&sort_field=active&sort_order=descending';
    return $request->send();
    
  }
  
  function updateUserProfile($website_id, $user_id, $payload) {
    
    $request = new request($this->client);
    $request->method = 'patch';
    $request->uri = '/website/'.$website_id.'/people/profile/'.$user_id;
    $request->payload = $payload;
    return $request->send();
    
  }
  
  function createUserProfile($website_id, $email, array $payload=array()) {

    // See if they exists
    $payload['email']  = $email;
    
    $request = new request($this->client);
    $request->method = 'post';
    $request->uri = '/website/'.$website_id.'/people/profile';
    
    if(!isset($payload['person']['nickname'])) $payload['person']['nickname'] = $email;
    
    $request->payload = $payload;
    return $request->send();
    
  }
  
  function overwriteUserData($website_id, $user_id, $kv_pairs) {
    
    foreach($kv_pairs as $key => $val) {
      $payload['data'][$key] = $val;
    }
    
    $request = new request($this->client);
    $request->method = 'put';
    $request->uri = '/website/'.$website_id.'/people/data/'.$user_id;
    $request->payload = $payload;
  
    return $request->send();
    
  }
  
  
}

?>