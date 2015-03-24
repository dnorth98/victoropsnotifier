<?php
namespace Signiant\VictorOps;

use GuzzleHttp\Client;


class MissingEndpointURLException extends \Exception
{
}

class Notifier implements Transport
{
    public function __construct($config)
    {
	$routing_key = "everyone";
			
	if (array_key_exists("routing_key",$config))
	{
		$routing_key = $config['routing_key'];
	}

	if (!array_key_exists("endpoint_url",$config))
	{
		throw (new MissingEndpointURLException());
	}
	
	$endpointURL = $config['endpoint_url'] . "/" . $routing_key;
		
        $this->endpoint = $endpointURL;

        $this->client = new Client();
    }

    public function send(Messages\Message $message)
    {
        $request = $this->client->createRequest('POST', $this->endpoint, [
            'json' => $message()
        ]);
        $this->client->send($request);
    }

}
