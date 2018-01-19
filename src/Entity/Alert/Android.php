<?php


namespace Fei\Service\Notification\Entity\Alert;

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
     * @return array
     *
     * @throws Android\Exception\AndroidPushException
     */
    public function getAndroidNotification(): array
    {
        return $this->getMessage()->buildArray();
    }

    /**
     * @inheritdoc
     */
    public function getType(): string
    {
        return 'android-push';
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
        $pushNotification = (!empty($data['message']['pushNotification'])) ?
            new Android\PushNotification($data['message']['pushNotification']) :
            new Android\PushNotification();
        $data['message']['pushNotification'] = $pushNotification;
        $data['message'] = (new Android\Message($data['message']));

        return parent::hydrate($data);
    }
}
