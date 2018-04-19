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
 * Class NotificationValidator
 *
 * @package Fei\Service\Notification\Validator\Alert\Sms
 */
class NotificationValidator extends AbstractValidator
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
        if (!$entity instanceof Notification) {
            throw new \Exception(
                sprintf('The Entity to validate must be an instance of %s', Notification::class)
            );
        }

        $this->validateBody($entity->getBody());
        $this->validateTitle($entity->getTitle());

        $errors = $this->getErrors();

        return empty($errors);
    }

    /**
     * @param $body
     * @return bool
     */
    public function validateBody($body)
    {
        if (!is_string($body) || empty($body)) {
            $this->addError('body', 'Body must be a string and not empty');
            return false;
        }

        return true;
    }

    /**
     * @param $title
     * @return bool
     */
    public function validateTitle($title)
    {
        if (!is_string($title) || empty($title)) {
            $this->addError('title', 'Title must be a string and not empty');
            return false;
        }

        return true;
    }

}
