<?php
namespace Fei\Service\Notification\Entity\Alert;

use Fei\Service\Notification\Entity\Alert;

/**
 * Class Email
 *
 * @package Fei\Service\Notification\Entity\Alert
 */
class Email extends AbstractAlert
{
    /** @var string */
    protected $email;

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
        $this->setType(Alert::ALERT_EMAIL);
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
        $this->type = Alert::ALERT_EMAIL;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getType(): string
    {
        return Alert::ALERT_EMAIL;
    }

    /**
     * Get Email
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set Email
     *
     * @param string $email
     *
     * @return self
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

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
}
