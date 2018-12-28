<?php
/**
 * Alert.php
 *
 * @date        28/12/18
 * @file        Alert.php
 */

namespace Fei\Service\Notification\Entity;

use ObjectivePHP\Gateway\Entity\Entity as ObjectiveEntity;

/**
 * Alert
 */
class Alert extends ObjectiveEntity
{

    const ALERT_EMAIL   = "EMAIL";
    const ALERT_ANDROID = "ANDROID";
    const ALERT_SMS     = "SMS";
    const ALERT_WS      = "WS";
    const ALERT_RSS     = "RSS";

    /** @var int */
    protected $id;

    /** @var string */
    protected $type;

    /** @var string */
    protected $subject;

    /** @var string */
    protected $message;

    /** @var string */
    protected $recipient;

    /** @var int */
    protected $notifId;

     /**
     * @var \DateTime
     * @Column(type="datetime")
     */
    protected $createdAt;

    /** @var int */
    protected $status;

    public function __construct()
    {
        $this->setCreatedAt(new \DateTime());
        $this->setStatus(0);
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setType($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * @param string $recipient
     *
     * @return $this
     */
    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;

        return $this;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     *
     * @return $this
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     *
     * @return $this
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return int
     */
    public function getNotifId()
    {
        return $this->notifId;
    }

    /**
     * @param int $notifid
     *
     * @return $this
     */
    public function setNotifId($notifid)
    {
        $this->notifId = $notifid;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    /**
     * @param $createdAt
     *
     * @return Payment
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $this->parseDate($createdAt);
        return $this;
    }

    /**
     * @var mixed $date
     *
     * @return \DateTime
     */
    protected function parseDate($date)
    {
        if (is_string($date)) {
            return new \DateTime($date);
        }
        return $date;
    }

    /**
     * @return string
     */
    public function getEntityCollection() : string
    {
        return 'alert';
    }

}
