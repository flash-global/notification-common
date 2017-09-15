<?php
namespace Fei\Service\Notification\Tests\Transformer;

use Fei\Service\Notification\Entity\Notification;
use Fei\Service\Notification\Transformer\NotificationTransformer;
use PHPUnit\Framework\TestCase;

class NotificationTransformerTest extends TestCase
{
    public function testTransform()
    {
        $expected = [
            'id'            => 3,
            'origin'        => 'fake-origin',
            'recipient'     => 'fake-recipient',
            'event'         => 'fake-event',
            'message'       => 'fake-message',
            'type'          => Notification::TYPE_WARNING,
            'created_at'    => new \DateTime('2017-04-12'),
            'status'        => Notification::STATUS_ACKNOWLEDGED,
            'parent_notification_id' => 2,
            'context'      => ['key' => 'value'],
            'action'        => json_encode(['url' => 'http://url.fr'])
        ];

        $notification = new Notification();

        foreach ($expected as $k => $v) {
            $k = explode('_', $k);
            $k = array_map('ucfirst', $k);
            $setter = 'set' . implode('', $k);
            $notification->$setter($v);
        }

        $transformer = new NotificationTransformer();
        $this->assertEquals($expected, $transformer->transform($notification));
    }
}
