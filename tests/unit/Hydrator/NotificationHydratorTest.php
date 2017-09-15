<?php
namespace Fei\Service\Notification\Tests\Transformer;

use Fei\Service\Notification\Entity\Notification;
use Fei\Service\Notification\Hydrator\NotificationHydrator;
use PHPUnit\Framework\TestCase;

class NotificationHydratorTest extends TestCase
{
    public function testExtract()
    {
        $hydrator = new NotificationHydrator();

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

        $expected = [
            'id' => 3,
            'origin' => 'fake-origin',
            'recipient' => 'fake-recipient',
            'event' => 'fake-event',
            'message' => 'fake-message',
            'type' => 2,
            'created_at' => $notification->getCreatedAt()->format('c'),
            'status' => Notification::STATUS_ACKNOWLEDGED,
            'parent_notification_id' => 2,
            'context' => ['key' => 'value'],
            'action' => ['url' => 'http://url.fr'],
        ] ;

        $this->assertEquals($expected, $hydrator->extract($notification));
    }

    public function testHydrate()
    {
        $hydrator = new NotificationHydrator();

        $notification = new Notification();

        $results = $hydrator->hydrate([
            'id' => 8,
            'event' => 'fake-event',
            'created_at' => '2017-04-12'
        ], $notification);

        $this->assertEquals($notification, $results);
    }
}
