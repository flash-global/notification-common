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
     * Construct
     *
     */
    public function __construct()
    {
	$this->setType(Alert::ALERT_RSS);
    }

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
     * Set Type
     *
     * @param string $type
     *
     * @return $this
     */
    public function setType(): self
    {
        $this->type = Alert::ALERT_RSS;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getType(): string
    {
        return Alert::ALERT_RSS;
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
}
