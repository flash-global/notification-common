<?php

namespace Fei\Service\Notification\Tests\Validator\Alert;

use Codeception\Util\Stub;
use Fei\Entity\EntityInterface;
use Fei\Service\Notification\Entity\Alert\Android;
use Fei\Service\Notification\Entity\Alert\Android\Message;
use Fei\Service\Notification\Entity\Notification;
use Fei\Service\Notification\Validator\Alert\AndroidValidator;
use PHPUnit\Framework\TestCase;

class AndroidValidatorTest extends TestCase
{
    public function testValidate()
    {
        $notification = (new Android\Notification())
            ->setTitle('title')
            ->setBody('body');

        $message = (new Message())
            ->setData(['data' => 'test'])
            ->setCondition('condition')
            ->setTopic('topic')
            ->setToken('token')
            ->setNotification($notification);

        $android = (new Android())
            ->setMessage($message);


        $validator = new AndroidValidator();

        $this->assertEquals(true, $validator->validate($android));
    }

    public function testValidateWrongEntity()
    {
        $this->expectException(\Exception::class);

        $message = new Message();

        $validator = new AndroidValidator();
        $validator->validate($message);
    }


    public function testSubElementErrorValidation()
    {
        $notification = (new Android\Notification())
            ->setTitle('title')
            ->setBody('');

        $message = (new Message())
            ->setData(['data' => 'test'])
            ->setCondition('condition')
            ->setTopic('topic')
            ->setToken('token')
            ->setNotification($notification);

        $android = (new Android())
            ->setMessage($message);


        $validator = new AndroidValidator();

        $this->assertEquals(false, $validator->validate($android));
    }
}
