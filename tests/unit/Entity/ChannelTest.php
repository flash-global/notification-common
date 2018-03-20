<?php
/**
 * ChannelTest.php
 *
 * @date        20/03/18
 * @file        ChannelTest.php
 */

namespace Fei\Service\Notification\Tests\Entity;

use Fei\Service\Notification\Entity\Channel;
use PHPUnit\Framework\TestCase;

/**
 * ChannelTest
 */
class ChannelTest extends TestCase
{
    public function testSetGet()
    {
        $data = [
            'id' => 1,
            'name' => 'test',
        ];
        $entity = new Channel();

        $entity->setId($data['id'])
            ->setName($data['name']);

        $this->assertEquals($entity->getId(), $data['id']);
        $this->assertEquals($entity->getName(), $data['name']);
    }
}
