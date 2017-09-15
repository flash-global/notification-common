<?php


namespace Fei\Service\Notification\Tests\Validator\Alert;

use Exception;
use Fei\Entity\EntityInterface;
use Fei\Service\Notification\Entity\Alert\Sms;
use Fei\Service\Notification\Entity\Alert\Sms\Message;
use Fei\Service\Notification\Entity\Notification;
use Fei\Service\Notification\Validator\Alert\SmsValidator;
use PHPUnit\Framework\TestCase;

class SmsValidatorTest extends TestCase
{

    public function testValidateWhenNotAnEntityInterface()
    {
        $mock = $this->getMockBuilder(EntityInterface::class)->getMock();

        $validator = new SmsValidator();

        $this->expectException(Exception::class);
        $this->expectExceptionMessage(sprintf('The Entity to validate must be an instance of %s', Sms::class));

        $validator->validate($mock);
    }


    public function testValidateWhenEntityIsNotASms()
    {
        $validator = new SmsValidator();
        $sms = 'fake-sms';

        $this->expectException(Exception::class);
        $this->expectExceptionMessage(sprintf('The Entity to validate must be an instance of %s', Sms::class));

        $validator->validate($sms);
    }

    public function testValidateWhenNotificationIsNotValid()
    {
        $validator = new SmsValidator();

        $message = (new Message())
            ->setFrom('fake-from')
            ->setContent('fake-content')
            ->addRecipient('003345678');

        $sms = (new Sms())
            ->setMessages($message);

        $results = $validator->validate($sms);

        $this->assertFalse($results);
        $this->assertEquals([
            'notification' => [sprintf('The notification has to be an instance of %s', Notification::class)]
        ], $validator->getErrors());
    }

    public function testValidateMessageSuccess()
    {
        $smsValidator = new SmsValidator();
        $messages = [
            (new Message())
                ->setFrom('fake-from')
                ->setContent('fake-content')
                ->addRecipient('003345678')
        ];

        $this->assertTrue($smsValidator->validateMessages($messages));
        $this->assertEmpty($smsValidator->getErrors());
    }

    public function testValidateMessagesFailMessageAsString()
    {
        $smsValidator = new SmsValidator();

        $fail = 'toto';
        $this->assertFalse($smsValidator->validateMessages($fail));
        $this->assertEquals([
            'messages' => ['Message must be an array and it can\'t be empty']
        ], $smsValidator->getErrors());
    }

    public function testValidateMessageFailArrayDataNotCorrect()
    {
        $smsValidator = new SmsValidator();
        $this->assertFalse($smsValidator->validateMessages(['toto']));
        $this->assertEquals([
            'messages' => [
                'This array must contains only instance of ' . Message::class
            ]
        ], $smsValidator->getErrors());
    }

    public function testValidateMessageFailEntityMessageNotValid()
    {
        $smsValidator = new SmsValidator();
        $message = (new Message())
            ->setContent('Content')
            ->setFrom('0667654323456')
            ->addRecipient('00667654321');

        $this->assertFalse($smsValidator->validateMessages([$message]));
        $this->assertEquals([
            'messages' => [
                'from: The input is more than 11 characters long'
            ]
        ], $smsValidator->getErrors());
    }

    public function testValidateNotificationSuccess()
    {
        $smsValidator = new SmsValidator();
        $notification = (new Notification())
            ->setMessage("test")
            ->setEvent("event")
            ->setRecipient('recipient')
            ->setOrigin("origin")
            ->setAction(["action"])
            ->setCreatedAt(new \Datetime())
            ->setType(1)
            ->setStatus(1);

        $this->assertTrue($smsValidator->validateNotification($notification));
    }

    public function testValidateNotificationFail()
    {
        $smsValidator = new SmsValidator();
        $notification = (new Notification())
            ->setMessage("test")
            ->setEvent("event")
            ->setRecipient('recipient')
            ->setOrigin("origin")
            ->setCreatedAt(new \Datetime())
            ->setAction('test')
            ->setType(1)
            ->setStatus(1);

        $this->assertFalse($smsValidator->validateNotification($notification));
        $this->assertEquals([
            'notification' => ['action: The input is not as JSON']
        ], $smsValidator->getErrors());
    }
}
