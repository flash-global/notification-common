<?php


namespace Fei\Service\Notification\Tests\Validator\Alert\Android;

use Exception;
use Fei\Service\Notification\Entity\Alert\Android\Message;
use Fei\Service\Notification\Entity\Alert\Android\PushNotification;
use Fei\Service\Notification\Validator\Alert\Android\MessageValidator;
use PHPUnit\Framework\TestCase;

class MessageValidatorTest extends TestCase
{
    public function testValidateFail()
    {
        $messageValidator =  new MessageValidator();
        $failTest = 'fail';

        $this->expectException(Exception::class);

        $messageValidator->validate($failTest);
    }

    public function testValidate()
    {
        $messageValidator =  new MessageValidator();
        $message = (new Message())
            ->addRecipient('fake-token')
            ->setPushNotification(new PushNotification());

        $res = $messageValidator->validate($message);

        $this->assertTrue($res);
    }

    public function testValidateRecipientsSuccess()
    {
        $messageValidator = new MessageValidator();
        $recipients = ['recipient-token-1', 'recipient-token-2'];

        $this->assertTrue($messageValidator->validateRecipients($recipients));
    }

    public function testValidateRecipientsFail()
    {
        $messageValidator = new MessageValidator();
        $recipients = [];

        $this->assertFalse($messageValidator->validateRecipients($recipients));
        $this->assertEquals([
            'recipients' => ['Recipients must be an array not empty']
        ], $messageValidator->getErrors());
    }

    public function testValidateTimeToLiveSuccess()
    {
        $messageValidator =  new MessageValidator();
        $ttl = 3456;

        $this->assertTrue($messageValidator->validateTimeToLive($ttl));
    }

    public function testValidateTimeToLiveFail()
    {
        $messageValidator =  new MessageValidator();
        $ttl = 'fake-ttl';

        $this->assertFalse($messageValidator->validateTimeToLive($ttl));
    }

    public function testValidateNotificationSuccess()
    {
        $messageValidator =  new MessageValidator();
        $notification = new PushNotification();

        $this->assertTrue($messageValidator->validateNotification($notification));
    }

    public function testValidateNotificationFail()
    {
        $messageValidator =  new MessageValidator();
        $notification = 'fake-notif';

        $this->assertFalse($messageValidator->validateNotification($notification));
    }
}
