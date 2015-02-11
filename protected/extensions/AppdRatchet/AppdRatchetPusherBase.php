<?php
namespace RExt;

use Ratchet\Wamp\Exception;
use Ratchet\Wamp\WampServerInterface;
use Ratchet\ConnectionInterface;

class AppdRatchetPusherBase implements WampServerInterface
{
    /**
     * A lookup of all the topics clients have subscribed to
     */
    protected $subscribedTopics = array();

    protected $entryNameKey = 'topicName';

    public function onSubscribe(ConnectionInterface $conn, $topic)
    {
        //$this->logger->writeString('onSubscribe call');
        $this->subscribedTopics[$topic->getId()] = $topic;
    }

    /**
     * @param string JSON'ified string we'll receive from ZeroMQ
     */
    public function onCommonEvent($entry)
    {
        $entryData = $this->decodeJsonEntry($entry);
        $topicName = $this->getEntryTopicName($entryData);

        // If the lookup topic object isn't set there is no one to publish to
        if (!array_key_exists($topicName, $this->subscribedTopics)) {
            return;
        }

        $topic = $this->subscribedTopics[$topicName];

        // re-send the data to all the clients subscribed to that category
        $topic->broadcast($entryData);
    }

    protected function getEntryTopicName($entry)
    {
        if (
            array_key_exists($this->entryNameKey, $entry)
            && !empty($entry[$this->entryNameKey])
        ) {
            return $entry[$this->entryNameKey];
        }
        throw new Exception('Invalid entry topic name');
    }

    protected function decodeJsonEntry($jsonEntry)
    {
        return json_decode($jsonEntry, true);
    }

    public function onUnSubscribe(ConnectionInterface $conn, $topic)
    {
    }

    public function onOpen(ConnectionInterface $conn)
    {
    }

    public function onClose(ConnectionInterface $conn)
    {
    }

    public function onCall(ConnectionInterface $conn, $id, $topic, array $params)
    {
        // In this application if clients send data it's because the user hacked around in console
        $conn->callError($id, $topic, 'You are not allowed to make calls')->close();
    }

    public function onPublish(ConnectionInterface $conn, $topic, $event, array $exclude, array $eligible)
    {
        // In this application if clients send data it's because the user hacked around in console
        $conn->close();
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
    }
}
