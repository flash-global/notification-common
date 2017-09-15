<?php
namespace Fei\Service\Notification\Tests\Validator;

use Codeception\Util\Stub;
use Fei\Service\Notification\Entity\Notification;
use Fei\Service\Notification\Validator\JsonValidator;
use Fei\Service\Notification\Validator\NotificationValidator;
use ObjectivePHP\Gateway\Entity\EntityInterface;
use PHPUnit\Framework\TestCase;
use Zend\Validator\InArray;
use Zend\Validator\IsInstanceOf;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;
use Zend\Validator\ValidatorChain;

class NotificationValidatorTest extends TestCase
{
    public function testValidateWhenNotAnEntityInterface()
    {
        $mock = $this->getMockBuilder(EntityInterface::class)->getMock();

        $validator = new NotificationValidator();

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage(sprintf('The Entity to validate must be an instance of %s', Notification::class));

        $validator->validate($mock);
    }

    public function testValidate()
    {
        $return = function () {
            return true;
        };

        $validator = Stub::make(NotificationValidator::class, [
            'validateOrigin' => Stub::once($return),
            'validateRecipient' => Stub::once($return),
            'validateEvent' => Stub::once($return),
            'validateMessage' => Stub::once($return),
            'validateType' => Stub::once($return),
            'validateCreatedAt' => Stub::once($return),
            'validateStatus' => Stub::once($return),
            'validateContexts' => Stub::once($return),
            'validateAction' => Stub::once($return),
            'getErrors' => Stub::once([]),
        ]);

        $results = $validator->validate(new Notification());

        $this->assertTrue($results);
    }

    public function testValidateOrigin()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject $validator */
        $validator = Stub::make(NotificationValidator::class, [
            'validateChain' => true
        ]);

        $chain = (new ValidatorChain())
            ->attach(new NotEmpty())
            ->attach(new StringLength(['max' => 255]));

        $validator->expects($this->once())->method('validateChain')->with($chain, 'fake-origin', 'origin');

        $results = $validator->validateOrigin('fake-origin');

        $this->assertTrue($results);
    }

    public function testValidateRecipient()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject $validator */
        $validator = Stub::make(NotificationValidator::class, [
            'validateChain' => true
        ]);

        $chain = (new ValidatorChain())
            ->attach(new NotEmpty())
            ->attach(new StringLength(['max' => 255]));

        $validator->expects($this->once())->method('validateChain')->with($chain, 'fake-recipient', 'recipient');

        $results = $validator->validateRecipient('fake-recipient');

        $this->assertTrue($results);
    }

    public function testValidateEvent()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject $validator */
        $validator = Stub::make(NotificationValidator::class, [
            'validateChain' => true
        ]);

        $chain = (new ValidatorChain())
            ->attach(new NotEmpty())
            ->attach(new StringLength(['max' => 255]));

        $validator->expects($this->once())->method('validateChain')->with($chain, 'fake-event', 'event');

        $results = $validator->validateEvent('fake-event');

        $this->assertTrue($results);
    }

    public function testValidateMessage()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject $validator */
        $validator = Stub::make(NotificationValidator::class, [
            'validateChain' => true
        ]);

        $chain = (new ValidatorChain())
            ->attach(new NotEmpty())
            ->attach(new StringLength(['max' => 4294967295]));

        $validator->expects($this->once())->method('validateChain')->with($chain, 'fake-message', 'message');

        $results = $validator->validateMessage('fake-message');

        $this->assertTrue($results);
    }

    public function testValidateType()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject $validator */
        $validator = Stub::make(NotificationValidator::class, [
            'validateChain' => true
        ]);

        $chain = (new ValidatorChain())
            ->attach(new NotEmpty())
            ->attach(new InArray([
                'haystack'=>[
                    Notification::TYPE_INFO,
                    Notification::TYPE_WARNING
                ]
            ]));

        $validator->expects($this->once())->method('validateChain')->with($chain, 'fake-type', 'type');

        $results = $validator->validateType('fake-type');

        $this->assertTrue($results);
    }

    public function testValidateCreatedAt()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject $validator */
        $validator = Stub::make(NotificationValidator::class, [
            'validateChain' => true
        ]);

        $chain = (new ValidatorChain())
            ->attach(new NotEmpty())
            ->attach(new IsInstanceOf(\DateTime::class));

        $validator->expects($this->once())->method('validateChain')->with($chain, 'fake-created-at', 'createdAt');

        $results = $validator->validateCreatedAt('fake-created-at');

        $this->assertTrue($results);
    }

    public function testValidateStatus()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject $validator */
        $validator = Stub::make(NotificationValidator::class, [
            'validateChain' => true
        ]);

        $chain = (new ValidatorChain())
            ->attach(new NotEmpty())
            ->attach(new InArray([
                'haystack'=> [
                    0,
                    Notification::STATUS_READ,
                    Notification::STATUS_ACKNOWLEDGED
                ]
            ]));

        $validator->expects($this->once())->method('validateChain')->with($chain, 'fake-status', 'status');

        $results = $validator->validateStatus('fake-status');

        $this->assertTrue($results);
    }

    public function testValidateAction()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject $validator */
        $validator = Stub::make(NotificationValidator::class, [
            'validateChain' => true
        ]);

        $chain = (new ValidatorChain())
            ->attach(new JsonValidator());

        $validator->expects($this->once())->method('validateChain')->with($chain, 'fake-action', 'action');

        $results = $validator->validateAction('fake-action');

        $this->assertTrue($results);
    }
}
