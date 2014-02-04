<?php

namespace BDK\AsyncDispatcherBundle\Model\EventDispatcher\AsyncDriver;

use BDK\AsyncDispatcherBundle\Model\EventDispatcher\AsyncEventInterface;
use BDK\AsyncDispatcherBundle\Model\EventDispatcher\AsyncEventDriverInterface;
use OldSound\RabbitMqBundle\RabbitMq\Producer;

class RabbitMQDriver implements AsyncEventDriverInterface
{
    protected $producer;

    protected $routingKey = '';

    public function __construct(Producer $producer)
    {
        $this->producer = $producer;
    }

    public function getName()
    {
        return 'rabbitmq_async_driver';
    }

    public function publish(AsyncEventInterface $event)
    {
        $this->producer->publish(serialize($event), $this->getRoutingKey());

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
