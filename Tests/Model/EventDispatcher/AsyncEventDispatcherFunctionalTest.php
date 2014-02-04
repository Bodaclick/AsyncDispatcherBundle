<?php

namespace BDK\AsyncDispatcherBundle\Tests\Model\EventDispatcher;

use BDK\AsyncDispatcherBundle\Model\EventDispatcher\AsyncEventDispatcher;
use BDK\AsyncDispatcherBundle\Model\EventDispatcher\AsyncEventDriverInterface;
use BDK\AsyncDispatcherBundle\Model\EventDispatcher\AsyncEventInterface;

class AsyncEventDispatcherFunctionalTest extends \PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        $driverStub = new AsyncDriverStub();
        unlink(__DIR__ . DIRECTORY_SEPARATOR . $driverStub->getName() . '.published');
    }

    public function testFunctionalDispatch()
    {
        $driverStub = new AsyncDriverStub();
        $eventMock = $this->getMockForAbstractClass('BDK\AsyncDispatcherBundle\Model\EventDispatcher\AsyncEventInterface');
        $eventMock->expects($this->any())->method('getName')->will($this->returnValue('mock.event'));
        $eventMock->expects($this->any())->method('getDriver')->will($this->returnValue($driverStub));

        $dispatcher = new AsyncEventDispatcher();
        $dispatcher->addDriver($driverStub, $eventMock->getName());
        $this->assertEquals($eventMock, $dispatcher->dispatch($eventMock));
        $this->assertTrue(file_exists(__DIR__ . DIRECTORY_SEPARATOR . $driverStub->getName() . '.published'));
    }
}

class AsyncDriverStub implements AsyncEventDriverInterface
{
    public function getName()
    {
        return 'stub.driver';
    }

    public function publish(AsyncEventInterface $event)
    {
        $fh = fopen(__DIR__ . DIRECTORY_SEPARATOR . $this->getName() . '.published', 'w');
        fclose($fh);
    }
}
