<?php

namespace Fei\Service\Notification\Entity\Alert;

use Fei\Service\Notification\Entity\Alert;

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
     * Construct
     *
     */
    public function __construct()
    {
        $this->setType(Alert::ALERT_WS);
    }

    /**
     * Set Type
     *
     * @param string $type
     *
     * @return $this
     */
    public function setType(): self
    {
        $this->type = Alert::ALERT_WS;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getType(): string
    {
        return Alert::ALERT_WS;
    }

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
}
