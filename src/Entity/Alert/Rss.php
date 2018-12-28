<?php
namespace Fei\Service\Notification\Entity\Alert;

use Fei\Service\Notification\Entity\Alert;

/**
 * Class Rss
 *
 * @package Fei\Service\Notification\Entity\Alert
 */
class Rss extends AbstractAlert
{
    /** @var string */
    protected $recipient;

    /** @var string */
    protected $subject;

    /** @var string */
    protected $content;

    /**
     * Get Recipient
     *
     * @return string
     */
    public function getRecipient(): string
    {
        return $this->recipient;
    }

    /**
     * Set Recipient
     *
     * @param string $recipient
     *
     * @return self
     */
    public function setRecipient(string $recipient): self
    {
        $this->recipient = $recipient;

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
     * @return self
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get Subject
     *
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * Set Subject
     *
     * @param string $subject
     *
     * @return $this
     */
    public function setSubject(string $subject): self
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getType(): string
    {
        return Alert::ALERT_RSS;
    }
}
