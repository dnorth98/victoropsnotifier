<?php

namespace Signiant\VictorOpsNotifer\Messages;

interface Message
{
	/**
	* return the data as a JSON string to send as message
	* to VictorOps REST endpoint
	* - return must be a json string with at least a message_type: key value pair
	* @return string
	*/
	public function asJson();
}
