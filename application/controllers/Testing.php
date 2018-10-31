<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Testing extends CI_Controller 
{
	$this->load->library('Facebook');
	$this->facebook->enable_debug(TRUE);
	public function facebook()
	{
		try {
  // Returns a `FacebookFacebookResponse` object
  $response = $fb->get(
    '/100026727998587',
    'EAACuxew3TroBABFnbctBdIKOiKrQpEiPUFPAREeERJ6SFmIAvDDaovPW30ihoi5V7YZAD6sYYfoJgGFVJMqReGyeUYRfooSKsUQfWaEit4wWwPSntWyPJDiQed7Vtp3hCOjEAep3eVVmx4zU5w0DElHB1XCQTZBZCqfqWtvMvBqvyoSiLTw0hZBUGZBNbXO0ZD'
  );
} catch(FacebookExceptionsFacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(FacebookExceptionsFacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
$graphNode = $response->getGraphNode();
var_dump($graphNode);
die;
	}

}
?>