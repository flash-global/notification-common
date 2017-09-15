<?php

namespace Fei\Service\Notification\Validator\Alert;

use Fei\Service\Notification\Entity\Alert\Android;
use Fei\Service\Notification\Entity\Notification;
use Fei\Service\Notification\Entity\Alert\Android\Message;
use Fei\Service\Notification\Validator\AbstractValidator;
use Fei\Service\Notification\Validator\NotificationValidator;
use Zend\Validator\IsInstanceOf;
use Zend\Validator\NotEmpty;
use Zend\Validator\ValidatorChain;

/**
 * Class AndroidValidator
 *
 * @package Fei\Service\Notification\Validator\Alert
 */
class AndroidValidator extends AbstractValidator
{
    public function validate($entity)
    {
        if (!$entity instanceof Android) {
            throw new \Exception(
                sprintf('The Entity to validate must be an instance of %s', Android::class)
            );
        }

        try {
            $this->validateNotification($entity->getNotification());
        } catch (\Exception $e) {
            $this->addError('notification', sprintf('The notification has to be an instance of %s', Notification::class));
        }

        $this->validateMessage($entity->getMessage());

        $errors = $this->getErrors();

        return empty($errors);
    }

    /**
     * Validate Message
     *
     * @param $message
     *
     * @return bool
     */
    public function validateMessage($message)
    {
        $chain = (new ValidatorChain())
            ->attach(new NotEmpty())
            ->attach(new IsInstanceOf(Message::class));

        return $this->validateChain($chain, $message, 'message');
    }

    /**
     * @param $notification
     *
     * @return bool
     */
    public function validateNotification($notification)
    {
        $validator = new NotificationValidator();
        if (!$validator->validate($notification)) {
            $this->addError('notification', $validator->getErrorsAsString());
            return false;
        }

        return true;
    }
}
