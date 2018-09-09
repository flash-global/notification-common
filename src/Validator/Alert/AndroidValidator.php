<?php

namespace Fei\Service\Notification\Validator\Alert;

use Fei\Service\Notification\Entity\Alert\Android;
use Fei\Service\Notification\Validator\AbstractValidator;
use Fei\Service\Notification\Validator\Alert\Android\MessageValidator;

/**
 * Class AndroidValidator
 *
 * @package Fei\Service\Notification\Validator\Alert
 */
class AndroidValidator extends AbstractValidator
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
        if (!$entity instanceof Android) {
            throw new \Exception(
                sprintf('The Entity to validate must be an instance of %s', Android::class)
            );
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
        $validator = new MessageValidator();

        $validated = $validator->validate($message);

        if (!$validated) {
            $this->addError('message', $validator->getErrorsAsString());
        }

        return $validated;
    }
}
