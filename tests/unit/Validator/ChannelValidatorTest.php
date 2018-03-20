<?php
/**
 * ChannelValidatorTest.php
 *
 * @date        20/03/18
 * @file        ChannelValidatorTest.php
 */

namespace Fei\Service\Notification\Tests\Validator;

use Fei\Service\Notification\Entity\Channel;
use Fei\Service\Notification\Entity\Notification;
use Fei\Service\Notification\Validator\ChannelValidator;
use PHPUnit\Framework\TestCase;

/**
 * ChannelValidatorTest
 */
class ChannelValidatorTest extends TestCase
{
    /**
     * @throws \Exception
     *
     * @expectedException \Exception
     */
    public function testWrongEntityType()
    {
        $entity =  new Notification();

        $validator = new ChannelValidator();

        $validator->validate($entity);
    }

    public function testValidate()
    {
        $entity = new Channel();
        $entity->setName('test');

        $validator = new ChannelValidator();

        $res = $validator->validate($entity);

        $this->assertTrue($res);
    }

    public function testValidateNameEmpty()
    {
        $entity = new Channel();

        $validator = new ChannelValidator();

        $validator->validateName($entity->getName());

        $this->assertNotEmpty($validator->getErrors());
    }

    public function testValidateNameTooLong()
    {
        $entity = new Channel();
        $entity->setName("azertiopmkjdsaertyuilkgfdsqiuytrezkjhgfdsuytrezhgfdsuytrezauytrez");

        $validator = new ChannelValidator();

        $validator->validateName($entity->getName());

        $this->assertNotEmpty($validator->getErrors());
    }
}
