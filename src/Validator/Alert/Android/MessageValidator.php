<?php

namespace Fei\Service\Notification\Validator\Alert\Android;

use Fei\Service\Notification\Entity\Alert\Android\Message;
use Fei\Service\Notification\Entity\Alert\Android\Notification;
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

        $this->validateData($entity->getData());
        $this->validateNotification($entity->getNotification());
        $this->validateToken($entity->getToken());
        $this->validateTopic($entity->getTopic());
        $this->validateCondition($entity->getCondition());

        $errors = $this->getErrors();

        return empty($errors);
    }

    /**
     * @param $data
     * @return bool
     */
    public function validateData($data)
    {
        if (!is_array($data)) {
            $this->addError('data', 'Recipients must be an array');
            return false;
        }

        return true;
    }

    /**
     * @param $token
     * @return bool
     */
    public function validateToken($token)
    {
        if (empty($token)) {
            return true;
        }

        if (!is_string($token)) {
            $this->addError('token', 'Token must be a string');
            return false;
        }

        return true;
    }

    /**
     * @param $topic
     * @return bool
     */
    public function validateTopic($topic)
    {
        if (empty($topic)) {
            return true;
        }

        if (!is_string($topic)) {
            $this->addError('topic', 'Topic must be a string');
            return false;
        }

        return true;
    }

    /**
     * @param $condition
     * @return bool
     */
    public function validateCondition($condition)
    {
        if (empty($condition)) {
            return true;
        }

        if (!is_string($condition)) {
            $this->addError('condition', 'Condition must be a string');
            return false;
        }

        return true;
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
        $validator = new NotificationValidator();
        $validated = $validator->validate($notification);

        if (!$validated) {
            $this->addError('notification', $validator->getErrorsAsString());
        }

        return $validated;
    }
}
