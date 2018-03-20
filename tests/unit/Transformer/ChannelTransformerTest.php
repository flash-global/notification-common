<?php
/**
 * ChannelTransformerTest.php
 *
 * @date        20/03/18
 * @file        ChannelTransformerTest.php
 */

namespace Fei\Service\Notification\Tests\Transformer;

use Fei\Service\Notification\Entity\Channel;
use Fei\Service\Notification\Transformer\ChannelTransformer;
use PHPUnit\Framework\TestCase;

/**
 * ChannelTransformerTest
 */
class ChannelTransformerTest extends TestCase
{
    public function testTransform()
    {
        $data = [
            'id' => 1,
            'name' => 'test',
        ];

        $channel = new Channel();

        $channel->setId($data['id'])
            ->setName($data['name']);

        $transformer = new ChannelTransformer();

        $this->assertEquals($data, $transformer->transform($channel));
    }
}
