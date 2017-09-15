<?php
namespace Fei\Service\Notification\Tests\Entity;

use DateInterval;
use Fei\Service\Notification\Entity\Alert\AbstractAlert;
use Fei\Service\Notification\Entity\Notification;
use PHPUnit\Framework\TestCase;

class AbstractAlertTest extends TestCase
{

    public function testNotificationTest()
    {
        $alert = new Class extends AbstractAlert{
            public function getType(): string
            {
                return 'tube';
            }
        };

        $notification = new Notification();
        $alert->setNotification($notification);

        $this->assertEquals($notification, $alert->getNotification());
        $this->assertAttributeEquals($alert->getNotification(), 'notification', $alert);
    }

    public function testTriggerTest()
    {
        $alert = new Class extends AbstractAlert {
            public function getType(): string
            {
                return 'tube';
            }
        };

        $alert->setTrigger(60);

        $this->assertEquals(60, $alert->getTrigger());
        $this->assertAttributeEquals($alert->getTrigger(), 'trigger', $alert);
    }
}
