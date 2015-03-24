<?php
namespace namespace Signiant\VictorOps\Messages;

class CustomMessage implements Message
{
    protected $message_type;

    protected $optionalFields = [];

    public function __construct($messageType)
    {
        $this->message_type = $messageType;
    }

    public function asJson()
    {
        $message = ['message_type' => $this->message_type];

        $message = array_merge($message, $this->optionalFields);

        return json_encode($message);
    }

    public function __invoke()
    {
        $message = ['message_type' => $this->message_type];

        $message = array_merge($message, $this->optionalFields);

        return $message;
    }

    public function entityId($entityId)
    {
        $this->optionalFields['entity_id'] = $entityId;
    }

    public function stateMessage($messageStr)
    {
        $this->optionalFields['state_message'] = $messageStr;
    }

    public function entityDisplayName($nameStr)
    {
        $this->optionalFields['entity_display_name'] = $nameStr;
    }

    public function ackMessage($messageStr)
    {
        $this->optionalFields['ack_msg'] = $messageStr;
    }

    public function ackAuthor($author)
    {
        $this->optionalFields['ack_author'] = $author;
    }

    public function entityIsHost($isHost)
    {
		if ($isHost)
		{
				$this->optionalFields['entity_is_host'] = 'y';
		} else
		{
				$this->optionalFields['entity_is_host'] = 'n';
		}
    }
}
