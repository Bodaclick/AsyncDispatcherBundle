<?php

namespace BDK\AsyncDispatcherBundle\Model\EventDispatcher\AsyncDriver;

use BDK\AsyncDispatcherBundle\Model\EventDispatcher\AsyncEventInterface;
use BDK\AsyncDispatcherBundle\Model\EventDispatcher\AsyncEventDriverInterface;
use JMS\Serializer\Serializer;
use OldSound\RabbitMqBundle\RabbitMq\Producer;

class RabbitMQDriver implements AsyncEventDriverInterface
{
    protected $producer;
    protected $serializer;

    protected $routingKey = '';

    public function __construct(Producer $producer, Serializer $serializer)
    {
        $this->producer = $producer;
        $this->serializer = $serializer;
    }

    public function getName()
    {
        return 'rabbitmq_async_driver';
    }

    public function publish(AsyncEventInterface $event)
    {
        $this->producer->publish($this->serializer->serialize($event, 'json'), $this->getRoutingKey());

        return $event;
    }

    public function setRoutingKey($routingKey)
    {
        $this->routingKey = $routingKey;
    }

    public function getRoutingKey()
    {
        return $this->routingKey;
    }
}
