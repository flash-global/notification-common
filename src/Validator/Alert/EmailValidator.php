<?php
namespace Fei\Service\Notification\Validator\Alert;


use Fei\Service\Notification\Entity\Alert\Email;
use Fei\Service\Notification\Entity\Notification;
use Fei\Service\Notification\Validator\AbstractValidator;
use Fei\Service\Notification\Validator\NotificationValidator;
use Zend\Validator\EmailAddress;
use Zend\Validator\ValidatorChain;

class EmailValidator extends AbstractValidator
{
    /**
     * Validate a Notification instance
     *
     * @param mixed $entity
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function validate($entity)
    {
        if (!$entity instanceof Email) {
            throw new \Exception(
                sprintf('The Entity to validate must be an instance of %s', Email::class)
            );
        }

        $this->validateEmail($entity->getEmail());

        try {
            $this->validateNotification($entity->getNotification());
        } catch (\Exception $e) {
            $this->addError('notification', sprintf('The notification has to be an instance of %s', Notification::class));
        }

        $errors = $this->getErrors();

        return empty($errors);
    }

    /**
     * Validate the email
     *
     * @param $email
     *
     * @return bool
     */
    public function validateEmail($email)
    {
        $chain = (new ValidatorChain())
            ->attach(new EmailAddress());

        return $this->validateChain($chain, $email, 'email');
    }

    /**
     * @param $notification
     *
     * @return bool
     *
     * @throws \Exception
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
