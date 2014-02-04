<?php

namespace BDK\AsyncDispatcherBundle\Tests\Model\EventDispatcher;

use BDK\AsyncDispatcherBundle\Model\EventDispatcher\AsyncDriver\RabbitMQDriver;
use OldSound\RabbitMqBundle\RabbitMq\Producer;

class RabbitMQDriverTest extends \PHPUnit_Framework_TestCase
{
    public function testInterface()
    {
        $producer = $this->getMockBuilder('OldSound\RabbitMqBundle\RabbitMq\Producer')
            ->disableOriginalConstructor()->getMock();

        $driver = new RabbitMQDriver($producer);
        $this->assertInstanceOf('BDK\AsyncDispatcherBundle\Model\EventDispatcher\AsyncEventDriverInterface', $driver);
    }

    public function testDriver()
    {
        $producer = $this->getMockBuilder('OldSound\RabbitMqBundle\RabbitMq\Producer')
            ->disableOriginalConstructor()->getMock();
        $producer->expects($this->once())->method('publish')->will($this->returnValue(true));

        $driver = new RabbitMQDriver($producer);
        $driver->setRoutingKey('test.core');
        $eventMock = $this->getMockForAbstractClass('BDK\AsyncDispatcherBundle\Model\EventDispatcher\AsyncEventInterface');
        $eventMock->expects($this->any())->method('getName')->will($this->returnValue('mock.event'));

        $this->assertEquals($eventMock, $driver->publish($eventMock));
        $this->assertEquals('test.core', $driver->getRoutingKey());
        $this->assertEquals('rabbitmq_async_driver', $driver->getName());
    }
}
