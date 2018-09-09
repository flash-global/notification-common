<?php


namespace Fei\Service\Notification\Tests\Entity;

use Fei\Service\Notification\Entity\Alert\Android;
use Fei\Service\Notification\Entity\Alert\Android\Message;
use PHPUnit\Framework\TestCase;

class AndroidTest extends TestCase
{
    public function testMessage()
    {
        $android = new Android();
        $message = new Message();
        $android->setMessage($message);

        $this->assertEquals($android->getMessage(), $message);
        $this->assertAttributeEquals($android->getMessage(), 'message', $android);
    }

    public function testGetTypeName()
    {
        $this->assertEquals('android-push', (new Android())->getType());
    }

    public function testHydrate()
    {
        $data = [
            'message' => [
                'notification' => [
                    'title' => 'fake-title',
                    'body' => 'fake-body'
                ]
            ]
        ];

        $android = new Android();

        $expected = (new Android())
            ->setMessage((new Message())
            ->setNotification((new Android\Notification())
            ->setTitle('fake-title')
            ->setBody('fake-body')));

        $this->assertEquals($expected, $android->hydrate($data));
    }
}
