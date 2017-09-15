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
    public function testValidateWhenNotAnEntityInterface()
    {
        $mock = $this->getMockBuilder(EntityInterface::class)->getMock();

        $validator = new AndroidValidator();

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage(sprintf('The Entity to validate must be an instance of %s', Android::class));

        $validator->validate($mock);
    }

    public function testValidateWhenEntityIsNotAnAndroidPush()
    {
        $androidValidator = new AndroidValidator();
        $android = '';

        $this->expectException(\Exception::class);

        $androidValidator->validate($android);
    }

    public function testValidate()
    {
        $return = function () {
            return true;
        };

        $validator = Stub::make(AndroidValidator::class, [
            'validateEmail' => Stub::once($return),
            'validateNotification' => Stub::once($return)
        ]);

        $android = (new Android())
            ->setMessage(new Message())
            ->setNotification(new Notification());

        $results = $validator->validate($android);

        $this->assertTrue($results);
    }

    public function testValidateWhenNotificationIsNotValid()
    {
        $validator = new AndroidValidator();

        $message = (new Message())
            ->setRecipients(['device1', 'device_2']);

        $android = (new Android())
            ->setMessage($message);

        $results = $validator->validate($android);

        $this->assertFalse($results);
        $this->assertEquals([
            'notification' => [sprintf('The notification has to be an instance of %s', Notification::class)]
        ], $validator->getErrors());
    }

    public function testValidateMessageSuccess()
    {

        $androidValidator = new AndroidValidator();
        $message = new Message();

        $this->assertTrue($androidValidator->validateMessage($message));
    }

    public function testValidateMessageFail()
    {

        $androidValidator = new AndroidValidator();
        $message = 'message';

        $this->assertFalse($androidValidator->validateMessage($message));
    }

    public function testValidateNotificationSuccess()
    {
        $androidValidator = new AndroidValidator();
        $notification = (new Notification())
            ->setMessage("test")
            ->setEvent("event")
            ->setRecipient('recipient')
            ->setOrigin("origin")
            ->setAction(["action"])
            ->setCreatedAt(new \Datetime())
            ->setType(1)
            ->setStatus(1);

        $this->assertTrue($androidValidator->validateNotification($notification));
    }

    public function testValidateNotificationFail()
    {
        $androidValidator = new AndroidValidator();
        $notification = (new Notification())
            ->setMessage("test")
            ->setEvent("event")
            ->setRecipient('recipient')
            ->setOrigin("origin")
            ->setCreatedAt(new \Datetime())
            ->setAction('test')
            ->setType(1)
            ->setStatus(1);

        $this->assertFalse($androidValidator->validateNotification($notification));
        $this->assertEquals([
            'notification' => ['action: The input is not as JSON']
        ], $androidValidator->getErrors());
    }
}
