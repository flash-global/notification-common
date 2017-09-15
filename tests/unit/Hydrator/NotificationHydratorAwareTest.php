<?php
namespace Fei\Service\Notification\Tests\Hydrator;

use Fei\Service\Notification\Hydrator\NotificationHydrator;
use Fei\Service\Notification\Hydrator\NotificationHydratorAware;
use PHPUnit\Framework\TestCase;

class NotificationHydratorAwareTest extends TestCase
{
    public function testNotificationHydratorAccessor()
    {
        $class = new class {
            use NotificationHydratorAware;
        };

        /** @var NotificationHydrator $hydratorMock */
        $hydratorMock = $this->getMockBuilder(NotificationHydrator::class)->getMock();

        $class->setNotificationHydrator($hydratorMock);

        $this->assertEquals($class->getNotificationHydrator(), $hydratorMock);
        $this->assertAttributeEquals($class->getNotificationHydrator(), 'notificationHydrator', $class);
    }
}
