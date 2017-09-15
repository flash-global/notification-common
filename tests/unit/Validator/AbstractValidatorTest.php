<?php
namespace Fei\Service\Notification\Tests\Validator;

use Fei\Service\Notification\Validator\AbstractValidator;
use ObjectivePHP\Gateway\Entity\EntityInterface;
use PHPUnit\Framework\TestCase;
use Zend\Validator\ValidatorChain;

class AbstractValidatorTest extends TestCase
{
    public function testValidateChainWhenValueIsValid()
    {
        $validatorChainMock = $this->getMockBuilder(ValidatorChain::class)
            ->setMethods(['isValid'])
            ->getMock();

        $validatorChainMock->expects($this->once())->method('isValid')->with('value')->willReturn(true);

        $validator = $this->getValidatorClass();

        /** @var ValidatorChain $validatorChainMock */
        $results = $validator->validateChain($validatorChainMock, 'value', 'attr');

        $this->assertTrue($results);
    }

    public function testValidateChainWhenValueIsNotValid()
    {
        $validatorChainMock = $this->getMockBuilder(ValidatorChain::class)
            ->setMethods(['isValid', 'getMessages'])
            ->getMock();

        $validatorChainMock->expects($this->once())->method('isValid')->with('value')->willReturn(false);
        $validatorChainMock->expects($this->once())->method('getMessages')->willReturn([
            'message1',
            'message2'
        ]);

        $validator = $this->getValidatorClass();

        /** @var ValidatorChain $validatorChainMock */
        $results = $validator->validateChain($validatorChainMock, 'value', 'attr');

        $this->assertFalse($results);
    }

    public function testGetErrors()
    {
        $validator = $this->getValidatorClass();
        $validator->addError('attr1', 'msg1');
        $validator->addError('attr2', 'msg2');

        $this->assertEquals([
            'attr1' => ['msg1'],
            'attr2' => ['msg2']
        ], $validator->getErrors());

        $this->assertEquals('attr1: msg1; attr2: msg2', $validator->getErrorsAsString());
    }

    public function testClearErrors()
    {
        $validator = $this->getValidatorClass();
        $validator->addError('attr1', 'msg1');
        $validator->addError('attr2', 'msg2');

        $results = $this->invokeMethod($validator, 'clearErrors');

        $this->assertEquals($results, $validator);
        $this->assertEquals([], $validator->getErrors());
    }

    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

    public function getValidatorClass()
    {
        return new class extends AbstractValidator {

            public function validate($entity)
            {
            }
        };
    }
}
