<?php


namespace Fei\Service\Notification\Entity\Alert;

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

    /**
     * @inheritdoc
     */
    public function getType(): string
    {
        return 'sms';
    }
}
