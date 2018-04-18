<?php
namespace Fei\Service\Notification\Tests\Entity\Alert\Android;

use Fei\Service\Notification\Entity\Alert\Android\Message;
use Fei\Service\Notification\Entity\Alert\Android\Notification;
use PHPUnit\Framework\TestCase;

class MessageTest extends TestCase
{
    public function testAccessors()
    {
        $notification = (new Notification())
            ->setTitle('title')
            ->setBody('body');

        $message = (new Message())
            ->setToken('token')
            ->setTopic('topic')
            ->setCondition('condition')
            ->setData(['test' => 'test'])
            ->setNotification($notification);

        $this->assertEquals($message->getToken(), 'token');
        $this->assertEquals($message->getTopic(), 'topic');
        $this->assertEquals($message->getCondition(), 'condition');
        $this->assertEquals($message->getData(), ['test' => 'test']);
        $this->assertEquals($message->getNotification(), $notification);
    }
}
