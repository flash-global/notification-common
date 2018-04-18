<?php

namespace Fei\Service\Notification\Tests\Validator\Alert\Android;

use Fei\Service\Notification\Entity\Alert\Android\Message;
use Fei\Service\Notification\Entity\Alert\Android\Notification;
use Fei\Service\Notification\Validator\Alert\Android\NotificationValidator;
use PHPUnit\Framework\TestCase;

class NotificationValidatorTest extends TestCase
{
    public function testValidate()
    {
        $notification = (new Notification())
            ->setTitle('title')
            ->setBody('body');

        $validator = new NotificationValidator();

        $this->assertEquals(true, $validator->validate($notification));
    }

    public function testValidateFailEntity()
    {
        $this->expectException(\Exception::class);

        $message = new Message();

        $validator = new NotificationValidator();

        $validator->validate($message);
    }

    public function testValidateFailValidation()
    {
        $notification = (new Notification())
            ->setBody('')
            ->setTitle('');

        $validator = new NotificationValidator();

        $this->assertEquals(false, $validator->validate($notification));
        $this->assertEquals(2, count($validator->getErrors()));
    }
}
