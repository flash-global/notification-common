<?php


namespace Fei\Service\Notification\Entity\Alert;

use Fei\Service\Notification\Entity\Alert;
use Fei\Service\Notification\Entity\Alert\Sms\Message;

/**
 * Class Sms
 *
 * @package Fei\Service\Notification\Entity\Alert
 */
class Sms extends AbstractAlert
{
    /**
     * @var Message[]
     */
    protected $messages;

    /**
     * Construct
     *
     */
    public function __construct()
    {
        $this->setType(Alert::ALERT_SMS);
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
        $this->type = Alert::ALERT_SMS;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getType(): string
    {
        return Alert::ALERT_SMS;
    }

    /**
     * Get Message
     *
     * @return Message[]
     */
    public function getMessages(): array
    {
        return $this->messages;
    }

    /**
     * Set Message
     *
     * @param Message[] $messages
     * @return $this|Sms
     */
    public function setMessages(...$messages): self
    {
        $this->messages = $messages;
        return $this;
    }
}
