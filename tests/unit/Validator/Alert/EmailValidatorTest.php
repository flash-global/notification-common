<?php
namespace Fei\Service\Notification\Tests\Validator\Alert;

use Codeception\Util\Stub;
use Exception;
use Fei\Service\Notification\Entity\Alert\Email;
use Fei\Service\Notification\Entity\Notification;
use Fei\Service\Notification\Validator\Alert\EmailValidator;
use ObjectivePHP\Gateway\Entity\EntityInterface;
use PHPUnit\Framework\TestCase;
use Zend\Validator\EmailAddress;
use Zend\Validator\ValidatorChain;

class EmailValidatorTest extends TestCase
{
    public function testValidateWhenNotAnEntityInterface()
    {
        $mock = $this->getMockBuilder(EntityInterface::class)->getMock();

        $validator = new EmailValidator();

        $this->expectException(Exception::class);
        $this->expectExceptionMessage(sprintf('The Entity to validate must be an instance of %s', Email::class));

        $validator->validate($mock);
    }

    public function testValidate()
    {
        $return = function () {
            return true;
        };

        $validator = Stub::make(EmailValidator::class, [
            'validateEmail' => Stub::once($return),
            'validateNotification' => Stub::once($return)
        ]);

        $results = $validator->validate((new Email())->setEmail('fake-email'));

        $this->assertTrue($results);
    }

    public function testValidateWhenEntityIsNotAnEmail()
    {
        $validator = new EmailValidator();
        $email = 'fake-email';

        $this->expectException(Exception::class);
        $this->expectExceptionMessage(sprintf('The Entity to validate must be an instance of %s', Email::class));

        $validator->validate($email);
    }

    public function testValidateWhenNotificationIsNotValid()
    {
        $validator = new EmailValidator();
        $email = (new Email())
            ->setEmail('fake-email@test.com');

        $results = $validator->validate($email);

        $this->assertFalse($results);
        $this->assertEquals([
            'notification' => [sprintf('The notification has to be an instance of %s', Notification::class)]
        ], $validator->getErrors());
    }

    public function testValidateEmail()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject $validator */
        $validator = Stub::make(EmailValidator::class, [
            'validateChain' => true
        ]);

        $chain = (new ValidatorChain())
            ->attach(new EmailAddress());

        $validator->expects($this->once())->method('validateChain')->with($chain, 'fake-email', 'email');

        $results = $validator->validateEmail('fake-email');

        $this->assertTrue($results);
    }

    public function testValidateNotificationSuccess()
    {
        $emailValidator = new EmailValidator();
        $notification = (new Notification())
            ->setMessage("test")
            ->setEvent("event")
            ->setRecipient('recipient')
            ->setOrigin("origin")
            ->setAction(["action"])
            ->setCreatedAt(new \Datetime())
            ->setType(1)
            ->setStatus(1);

        $this->assertTrue($emailValidator->validateNotification($notification));
    }

    public function testValidateNotificationFail()
    {
        $emailValidator = new EmailValidator();
        $notification = (new Notification())
            ->setMessage("test")
            ->setEvent("event")
            ->setRecipient('recipient')
            ->setOrigin("origin")
            ->setCreatedAt(new \Datetime())
            ->setAction('test')
            ->setType(1)
            ->setStatus(1);

        $this->assertFalse($emailValidator->validateNotification($notification));
        $this->assertEquals([
            'notification' => ['action: The input is not as JSON']
        ], $emailValidator->getErrors());
    }
}
