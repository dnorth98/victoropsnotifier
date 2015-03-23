<?php

namespace Signiant\VictorOpsNotifer;

use GuzzleHttp\Client;

class MissingEndpointURLException extends \Exception
{
}

interface Transport
{
	// must POST the $message to the VictorOps REST endpoint 

	public function send(Messages\Message $message);
}

class VictorOpsNotifer implements Transport
{
    protected $endpoint_url;
    protected $routing_key;

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
