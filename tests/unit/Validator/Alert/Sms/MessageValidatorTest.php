<?php


namespace Fei\Service\Notification\Tests\Validator\Alert\Sms;

use Exception;
use Fei\Service\Notification\Entity\Alert\Sms\Message;
use Fei\Service\Notification\Validator\Alert\Sms\MessageValidator;
use PHPUnit\Framework\TestCase;

class MessageValidatorTest extends TestCase
{
    public function testValidateFail()
    {

        $smsValidator =  new MessageValidator();

        $failTest = 'fail';

        $this->expectException(Exception::class);

        $smsValidator->validate($failTest);
    }

    public function testValidate()
    {

        $smsValidator =  new MessageValidator();
        $message = (new Message())
            ->setFrom('fake-from')
            ->setContent('fake-content')
            ->addRecipient('003345678');

        $res = $smsValidator->validate($message);

        $this->assertTrue($res);
    }

    public function testValidateFromSuccess()
    {
        $smsValidator = new MessageValidator();

        $from = 'fake-from';

        $this->assertTrue($smsValidator->validateFrom($from));
    }

    public function testValidateFromFailure()
    {
        $smsValidator = new MessageValidator();

        $from = 'fake-from-fail';


        $this->assertFalse($smsValidator->validateFrom($from));
    }

    public function testValidateContentSuccess()
    {
        $smsValidator = new MessageValidator();
        $content = 'fake-content';

        $this->assertTrue($smsValidator->validateContent($content));
    }

    public function testValidateContentFailure()
    {
        $smsValidator = new MessageValidator();

        $content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas augue erat, 
        euismod vitae malesuada eget, euismod vitae sem. Ut mattis tellus vel bibendum commodo. 
        Etiam nulla nibh, gravida at amet.';


        $this->assertFalse($smsValidator->validateContent($content));
    }

    public function testValidateRecipientsSuccess()
    {
        $smsValidator = new MessageValidator();

        $message = (new Message())
            ->setFrom('fake-from-fail')
            ->setRecipients(['34567'])
            ->setContent('Lorem ipsum dolor sit vel bibendum commodo. Etiam nulla nibh, gravida at amet.');

        $this->assertFalse($smsValidator->validateRecipients($message));
    }

    public function testValidateRecipientsFailureNotArrayOrEmpty()
    {
        $smsValidator = new MessageValidator();
        $recipients = 'fake-recipients';

        $this->assertFalse($smsValidator->validateRecipients($recipients));
        $this->assertEquals([
            'recipients' => ['Recipients must be an array not empty']
        ], $smsValidator->getErrors());

        $smsValidator = new MessageValidator();
        $recipients = [];

        $this->assertFalse($smsValidator->validateRecipients($recipients));
        $this->assertEquals([
            'recipients' => ['Recipients must be an array not empty']
        ], $smsValidator->getErrors());
    }

    public function testValidateRecipientsFailureArrayMalformed()
    {
        $smsValidator = new MessageValidator();
        $recipients = [
            0 => [
                'toto'
            ]
        ];

        $this->assertFalse($smsValidator->validateRecipients($recipients));
        $this->assertEquals([
            'recipients' => ['Format error for recipient']
        ], $smsValidator->getErrors());

        $smsValidator = new MessageValidator();
        $recipients = [
            0 => [
                'toto' => '456789'
            ]
        ];

        $this->assertFalse($smsValidator->validateRecipients($recipients));
        $this->assertEquals([
            'recipients' => ['Format error for recipient']
        ], $smsValidator->getErrors());
    }
}
