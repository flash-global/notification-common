<?php

namespace Fei\Service\Notification\Validator\Alert;

use Fei\Service\Notification\Entity\Alert\Sms;
use Fei\Service\Notification\Entity\Notification;
use Fei\Service\Notification\Entity\Alert\Sms\Message;
use Fei\Service\Notification\Validator\AbstractValidator;
use Fei\Service\Notification\Validator\Alert\Sms\MessageValidator;
use Fei\Service\Notification\Validator\NotificationValidator;

/**
 * Class SmsValidator
 *
 * @package Fei\Service\Notification\Validator\Alert
 */
class SmsValidator extends AbstractValidator
{

    public function validate($entity)
    {
        if (!$entity instanceof Sms) {
            throw new \Exception(
                sprintf('The Entity to validate must be an instance of %s', Sms::class)
            );
        }

        try {
            $this->validateNotification($entity->getNotification());
        } catch (\Exception $e) {
            $this->addError('notification', sprintf('The notification has to be an instance of %s', Notification::class));
        }

        $this->validateMessages($entity->getMessages());

        $errors = $this->getErrors();

        return empty($errors);
    }

    /**
     * validate message
     *
     * @param $message
     *
     * @return bool
     */
    public function validateMessages($message)
    {
        if (!is_array($message) || empty($message)) {
            $this->addError('messages', 'Message must be an array and it can\'t be empty');
            return false;
        }

        foreach ($message as $entity) {
            if (!$entity instanceof Message) {
                $this->addError('messages', sprintf('This array must contains only instance of %s', Message::class));
                return false;
            }

            $messageValidator = new MessageValidator();
            if (!$messageValidator->validate($entity)) {
                $this->addError('messages', $messageValidator->getErrorsAsString());
                return false;
            }
        }

        return true;
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
