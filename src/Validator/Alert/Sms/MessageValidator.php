<?php

namespace Fei\Service\Notification\Validator\Alert\Sms;

use Fei\Service\Notification\Entity\Alert\Sms\Message;
use Fei\Service\Notification\Validator\AbstractValidator;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;
use Zend\Validator\ValidatorChain;

/**
 * Class Message
 *
 * @package Fei\Service\Notification\Validator\Alert\Sms
 */
class MessageValidator extends AbstractValidator
{

    public function validate($entity)
    {
        if (!$entity instanceof Message) {
            throw new \Exception(
                sprintf('The Entity to validate must be an instance of %s', Message::class)
            );
        }

        $this->validateFrom($entity->getFrom());
        $this->validateContent($entity->getContent());
        $this->validateRecipients($entity->getRecipients());

        $errors = $this->getErrors();

        return empty($errors);
    }

    /**
     * Validate from
     *
     * @param $from
     *
     * @return bool
     */
    public function validateFrom($from)
    {
        $chain = (new ValidatorChain())
            ->attach(new NotEmpty())
            ->attach(new StringLength(['max' => 11]));

        return $this->validateChain($chain, $from, 'from');
    }

    /**
     * validate content
     *
     * @param $content
     *
     * @return bool
     */
    public function validateContent($content)
    {
        $chain = (new ValidatorChain())
            ->attach(new NotEmpty())
            ->attach(new StringLength(['max' => 160]));

        return $this->validateChain($chain, $content, 'content');
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

        foreach ($recipients as $recipient) {
            if (!is_numeric($recipient)) {
                $this->addError('recipients', 'Format error for recipient');
                return false;
            }
        }
        return true;
    }
}
