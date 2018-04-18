<?php


namespace Fei\Service\Notification\Tests\Entity;

use PHPUnit\Framework\TestCase;
use Fei\Service\Notification\Entity\Alert\WebSocket;

class WebSocketTest extends TestCase
{
    public function testGetType()
    {
        $websocket = new WebSocket();

        $this->assertEquals('websocket', $websocket->getType());
    }

    public function testAction()
    {
        $websocket = new WebSocket();
        $websocket->setAction('test');

        $this->assertEquals('test', $websocket->getAction());
    }
}
