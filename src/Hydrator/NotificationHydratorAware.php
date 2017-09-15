<?php
namespace Fei\Service\Notification\Hydrator;

/**
 * Class NotificationHydratorAware
 * @package Fei\Service\Notification\Hydrator
 */
trait NotificationHydratorAware
{
    /** @var NotificationHydrator */
    protected $notificationHydrator;

    /**
     * Get NotificationHydrator
     *
     * @return NotificationHydrator
     */
    public function getNotificationHydrator()
    {
        return $this->notificationHydrator;
    }

    /**
     * Set NotificationHydrator
     *
     * @param NotificationHydrator $notificationHydrator
     *
     * @return $this
     */
    public function setNotificationHydrator(NotificationHydrator $notificationHydrator)
    {
        $this->notificationHydrator = $notificationHydrator;
        return $this;
    }
}
