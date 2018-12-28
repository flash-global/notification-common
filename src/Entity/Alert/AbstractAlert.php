<?php
namespace Fei\Service\Notification\Entity\Alert;

use Fei\Entity\AbstractEntity;
use Fei\Service\Notification\Entity\Notification;

/**
 * Class AbstractAlert
 * @package Fei\Service\Notification\Entity\Alert
 */
abstract class AbstractAlert extends AbstractEntity
{
    /**
     * @var Notification
     */
    protected $notification;

    /**
     * @var int
     */
    protected $trigger = null;

    /**
     * Get Notification
     *
     * @return Notification
     */
    public function getNotification()
    {
        return $this->notification;
    }

    /**
     * Set Notification
     *
     * @param Notification $notification
     *
     * @return self
     */
    public function setNotification(Notification $notification): self
    {
        $this->notification = $notification;

        return $this;
    }

    /**
     * Get Trigger
     *
     * @return int
     */
    public function getTrigger()
    {
        return $this->trigger;
    }

    /**
     * Set Trigger
     *
     * @param int $trigger the number of minutes
     *
     * @return self
     */
    public function setTrigger(int $trigger = 0): self
    {
        $this->trigger = $trigger;

        return $this;
    }

}
