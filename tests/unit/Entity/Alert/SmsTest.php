<?php


namespace Fei\Service\Notification\Tests\Entity;

use Fei\Service\Notification\Entity\Alert;
use Fei\Service\Notification\Entity\Alert\Sms;
use Fei\Service\Notification\Entity\Alert\Sms\Message;
use PHPUnit\Framework\TestCase;

class SmsTest extends TestCase
{
    public function testAccessors()
    {
        $message = new Message();

        $this->testOneAccessors('messages', $message, [$message]);
    }

    public function testGetTypeName()
    {
        $this->assertEquals(Alert::ALERT_SMS, (new Sms())->getType());
    }

    protected function testOneAccessors($name, $set, $expected = null)
    {
        $expected = $expected ?? $set;

        $setter = 'set' . ucfirst($name);
        $getter = 'get' . ucfirst($name);

        $notification = new Sms();
        $notification->$setter($set);

        $this->assertEquals($notification->$getter(), $expected);
        $this->assertAttributeEquals($notification->$getter(), $name, $notification);
    }
}
