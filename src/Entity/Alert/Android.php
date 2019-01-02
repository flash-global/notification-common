<?php


namespace Fei\Service\Notification\Entity\Alert;

use Fei\Service\Notification\Entity\Alert;
use Fei\Service\Notification\Entity\Alert\Android\Message;

/**
 * Class Android
 *
 * @package Fei\Service\Notification\Entity\Alert
 */
class Android extends AbstractAlert
{
    /**
     * @var Message
     */
    protected $message;

    /**
     * Construct
     *
     */
    public function __construct()
    {
        $this->setType(Alert::ALERT_ANDROID);
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
        $this->type = Alert::ALERT_ANDROID;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getType(): string
    {
        return Alert::ALERT_ANDROID;
    }

    /**
     * Get Message
     *
     * @return Message
     */
    public function getMessage(): Message
    {
        return $this->message;
    }

    /**
     * Set Message
     *
     * @param Message $message
     *
     * @return self
     */
    public function setMessage(Message $message): self
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @param $data
     *
     * @return $this
     *
     * @throws \Fei\Entity\Exception
     */
    public function hydrate($data)
    {
        $pushNotification = (!empty($data['message']['notification'])) ?
            new Android\Notification($data['message']['notification']) :
            new Android\Notification();
        $data['message']['notification'] = $pushNotification;
        $data['message'] = (new Android\Message($data['message']));

        return parent::hydrate($data);
    }
}
