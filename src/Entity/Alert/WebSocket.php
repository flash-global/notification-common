<?php
namespace Fei\Service\Notification\Entity\Alert;

/**
 * Class WebSocket
 *
 * @package Fei\Service\Notification\Entity\Alert
 */
class WebSocket extends AbstractAlert
{
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
