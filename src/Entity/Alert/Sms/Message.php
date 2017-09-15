<?php


namespace Fei\Service\Notification\Entity\Alert\Sms;

use Fei\Entity\AbstractEntity;

/**
 * Class Message
 *
 * @package Fei\Service\Notification\Entity\Alert\Sms
 */
class Message extends AbstractEntity
{
    /**
     * @var string
     */
    protected $from;

    /**
     * @var array
     */
    protected $recipients;

    /**
     * content of sms
     * @var string
     */
    protected $content;

    /**
     * Get From
     *
     * @return string
     */
    public function getFrom(): string
    {
        return $this->from;
    }

    /**
     * Set From
     *
     * @param string $from
     *
     * @return $this
     */
    public function setFrom(string $from): self
    {
        $this->from = $from;
        return $this;
    }

    /**
     * Get Recipients
     *
     * @return array
     */
    public function getRecipients(): array
    {
        return $this->recipients;
    }

    /**
     * Set Recipients
     *
     * @param array $recipients
     *
     * @return $this
     */
    public function setRecipients(array $recipients): self
    {
        $this->recipients = $recipients;
        return $this;
    }

    /**
     * Get Content
     *
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Set Content
     *
     * @param string $content
     *
     * @return $this
     */
    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @param string $number international number
     * example for a call to France (without []) : [00][33][6876544332]
     *
     * @return Message
     */
    public function addRecipient(string $number): self
    {
        $this->recipients[] = $number;
        return $this;
    }
}
