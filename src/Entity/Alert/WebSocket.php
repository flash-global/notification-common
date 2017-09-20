<?php
namespace Fei\Service\Notification\Entity\Alert;

/**
 * Class WebSocket
 *
 * @package Fei\Service\Notification\Entity\Alert
 */
class WebSocket extends AbstractAlert
{
    const ACTION_NEW = "NEW";
    const ACTION_UPDATE = "UPDATE";

    protected $action = self::ACTION_NEW;

    /**
     * @return string
     */
    public function getAction() : string
    {
        return $this->action;
    }

    /**
     * @param string $action
     * @return $this
     */
    public function setAction(string $action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get the type of the alert (email, sms, etc.)
     *
     * @return string
     */
    public function getType(): string
    {
        return 'websocket';
    }
}
