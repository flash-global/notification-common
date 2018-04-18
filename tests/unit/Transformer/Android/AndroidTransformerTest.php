<?php

namespace Fei\Service\Notification\Tests\Transformer\Android;

use Fei\Service\Notification\Entity\Alert\Android;
use Fei\Service\Notification\Entity\Alert\Android\Message;
use Fei\Service\Notification\Entity\Channel;
use Fei\Service\Notification\Transformer\Alert\AndroidTransformer;
use Fei\Service\Notification\Transformer\ChannelTransformer;
use PHPUnit\Framework\TestCase;

/**
 * AndroidTransformerTest
 */
class AndroidTransformerTest extends TestCase
{
    public function testTransform()
    {
        $messageData = [
            'data' => ['data' => 'test'],
            'notification' => [
                'title' => 'title',
                'body' => 'body'
            ],
            'token' => 'token',
            'topic' => 'topic',
            'condition' => 'condition'
        ];

        $data = [
            'message' => $messageData
        ];

        $message = (new Message())
            ->setData($messageData['data'])
            ->setCondition($messageData['condition'])
            ->setTopic($messageData['topic'])
            ->setToken($messageData['token'])
            ->setNotification(
                (new Android\Notification())
                    ->setBody($messageData['notification']['body'])
                    ->setTitle($messageData['notification']['title'])
            );

        $android = new Android();
        $android->setMessage($message);

        $transformer = new AndroidTransformer();

        $this->assertEquals($data, $transformer->transform($android));
    }
}
