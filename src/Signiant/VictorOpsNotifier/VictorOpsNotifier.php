<?php

namespace Signiant\VictorOpsNotifer;

use GuzzleHttp\Client;

class VictorOpsNotifer implements Transport
{
    public function __construct($config)
    {
	$routing_key = "everyone";
			
	if (array_key_exists("routing_key",$config))
	{
		$routing_key = $config['routing_key'];
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
