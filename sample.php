<?php

	require 'vendor/autoload.php';

	use Signiant\VictorOps\Notifier;
	use Signiant\VictorOps\Messages\CustomMessage;

	$routingKey = 'mykey';
	$REST_URL= 'my VO REST URL';

	$VictorOpsConfig = ['routing_key' => $routingKey, 'endpoint_url' => $REST_URL]; 

	$VOendpointOK = true;
	try
	{
		$voEndpoint = new Notifier($VictorOpsConfig);

	} catch (MissingEndpointURLException $e)
	{
		echo "caught exception: . " . $e->getMessage() . "\n";
		$VOendpointOK = false;
	}

	if ($VOendpointOK)
	{
		// Setup the message.  Only the level is mandatory
		$msgLevel = "INFO";
		$voMsg = new CustomMessage($msgLevel);

		$voMsg->stateMessage('The answer is 42');
		$voMsg->entityId('system123');
		$voMsg->entityDisplayName('HAL 9000');

		$voEndpoint->send($voMsg);
	}
?>

