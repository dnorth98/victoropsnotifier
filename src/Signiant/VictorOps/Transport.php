<?php
namespace Signiant\VictorOps;

interface Transport
{
	// must POST the $message to the VictorOps REST endpoint 

	public function send(Messages\Message $message);
}

