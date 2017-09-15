<?php
namespace Fei\Service\Notification\Tests\Validator;

use Codeception\Util\Stub;
use Fei\Service\Notification\Validator\JsonValidator;
use PHPUnit\Framework\TestCase;

class JsonValidatorTest extends TestCase
{
    public function testIsValidWhenJSonIsValid()
    {
        $jsonValidator = new JsonValidator();
        $results = $jsonValidator->isValid(json_encode(['el1', 'el2']));

        $this->assertTrue($results);
    }

    public function testIsValidWhenJSonIsNotValid()
    {
        $jsonValidator = Stub::make(JsonValidator::class, [
            'addError' => Stub::once()
        ]);
        $results = $jsonValidator->isValid('{');

        $this->assertFalse($results);
    }
}
