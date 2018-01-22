<?php

namespace Fei\Service\Notification\Validator\Alert\Android;

use Fei\Service\Notification\Entity\Alert\Android\Message;
use Fei\Service\Notification\Entity\Alert\Android\PushNotification;
use Fei\Service\Notification\Validator\AbstractValidator;
use Zend\Filter\FilterChain;
use Zend\Validator\Digits;
use Zend\Validator\IsInstanceOf;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;
use Zend\Validator\ValidatorChain;

/**
 * Class MessageValidator
 *
 * @package Fei\Service\Notification\Validator\Alert\Sms
 */
class MessageValidator extends AbstractValidator
{

    /**
     * @param $entity
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function validate($entity)
    {
        if (!$entity instanceof Message) {
            throw new \Exception(
                sprintf('The Entity to validate must be an instance of %s', Message::class)
            );
        }

        $this->validateRecipients($entity->getRecipients());
        $this->validateTimeToLive($entity->getTimeToLive());
        $this->validateNotification($entity->getPushNotification());

        $errors = $this->getErrors();

        return empty($errors);
    }

    /**
     * validate recipients
     *
     * @param $recipients
     *
     * @return bool
     */
    public function validateRecipients($recipients)
    {
        if (!is_array($recipients) || empty($recipients)) {
            $this->addError('recipients', 'Recipients must be an array not empty');
            return false;
        }

        return true;
    }

    /**
     * Validate timeToLive
     *
     * @param $timeToLive
     *
     * @return bool
     */
    public function validateTimeToLive($timeToLive)
    {
        $chain = (new ValidatorChain())
            ->attach(new Digits());

        return $this->validateChain($chain, $timeToLive, 'timeToLive');
    }

    /**
     * Validate Notification
     *
     * @param $notification
     *
     * @return bool
     */
    public function validateNotification($notification)
    {
        $chain = (new ValidatorChain())
            ->attach(new NotEmpty())
            ->attach(new IsInstanceOf(PushNotification::class));

        return $this->validateChain($chain, $notification, 'notification');
    }
}
