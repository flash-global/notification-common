<?php

namespace Fei\Service\Notification\Tests\Validator\Alert\Android;

use Fei\Service\Notification\Entity\Alert\Android\Message;
use Fei\Service\Notification\Entity\Alert\Android\Notification;
use Fei\Service\Notification\Validator\Alert\Android\MessageValidator;
use PHPUnit\Framework\TestCase;

class MessageValidatorTest extends TestCase
{
    public function getData()
    {
        $notification = (new Notification())
            ->setTitle('title')
            ->setBody('body');

        $notification2 = (new Notification())
            ->setTitle('')
            ->setBody('');

        return [
            [[
                'token' => 'token',
                'topic' => 'topic',
                'condition' => 'condition',
                'data' => ['data' => 'test'],
                'notification' => $notification
            ], false],
            [[
                'token' => '',
                'topic' => '',
                'condition' => '',
                'data' => [],
                'notification' => $notification
            ], false],
            [[
                'token' => 22,
                'topic' => 22,
                'condition' => 22,
                'data' => 22,
                'notification' => $notification
            ], true, 4],
            [[
                'token' => '',
                'topic' => '',
                'condition' => '',
                'data' => [],
                'notification' => $notification2
            ], true, 1],
        ];
    }

    /**
     * @dataProvider getData
     */
    public function testValidation($data, $error, $count = 0)
    {
        $message = (new Message())
            ->setToken($data['token'])
            ->setTopic($data['topic'])
            ->setCondition($data['condition'])
            ->setData($data['data'])
            ->setNotification($data['notification']);

        $validator = new MessageValidator();

        $this->assertEquals(!$error, $validator->validate($message));

        if ($error) {
            $this->assertEquals($count, count($validator->getErrors()));
        }
    }

    public function testValidateWrongEntity()
    {
        $this->expectException(\Exception::class);

        $wrong = new Notification();

        $validator = new MessageValidator();
        $validator->validate($wrong);
    }
}
