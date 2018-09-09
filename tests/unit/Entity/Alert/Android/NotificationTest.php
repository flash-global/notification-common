<?php
namespace Fei\Service\Notification\Tests\Entity\Alert\Android;

use Fei\Service\Notification\Entity\Alert\Android\Notification;
use PHPUnit\Framework\TestCase;

class NotificationTest extends TestCase
{
    public function testAccessors()
    {
        $notification = (new Notification())
            ->setBody('test body')
            ->setTitle('test title');

        $this->assertEquals($notification->getBody(), 'test body');
        $this->assertEquals($notification->getTitle(), 'test title');
    }
}
