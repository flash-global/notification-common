<?php
namespace Fei\Service\Notification\Validator;

use Zend\Validator\IsInstanceOf;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;
use Zend\Validator\ValidatorChain;
use Zend\Validator\InArray;
use Fei\Service\Notification\Entity\Notification;

/**
 * Class NotificationValidator
 *
 * @package Notification\Common\Validator
 */
class NotificationValidator extends AbstractValidator
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
        if (!$entity instanceof Notification) {
            throw new \Exception(
                sprintf('The Entity to validate must be an instance of %s', Notification::class)
            );
        }

        $this->validateOrigin($entity->getOrigin());
        $this->validateRecipient($entity->getRecipient());
        $this->validateEvent($entity->getEvent());
        $this->validateMessage($entity->getMessage());
        $this->validateType($entity->getType());
        $this->validateCreatedAt($entity->getCreatedAt());
        $this->validateStatus($entity->getStatus());
        $this->validateAction($entity->getAction());

        $errors = $this->getErrors();

        return empty($errors);
    }

    /**
     * @param $origin
     *
     * @return bool
     */
    public function validateOrigin($origin)
    {
        $chain = (new ValidatorChain())
            ->attach(new NotEmpty())
            ->attach(new StringLength(['max' => 255]));

        return $this->validateChain($chain, $origin, 'origin');
    }

    /**
     * @param $recipient
     *
     * @return bool
     */
    public function validateRecipient($recipient)
    {
        $chain = (new ValidatorChain())
            ->attach(new NotEmpty())
            ->attach(new StringLength(['max' => 255]));

        return $this->validateChain($chain, $recipient, 'recipient');
    }

    /**
     * @param $event
     *
     * @return bool
     */
    public function validateEvent($event)
    {
        $chain = (new ValidatorChain())
            ->attach(new NotEmpty())
            ->attach(new StringLength(['max' => 255]));

        return $this->validateChain($chain, $event, 'event');
    }

    /**
     * @param $message
     *
     * @return bool
     */
    public function validateMessage($message)
    {
        $chain = (new ValidatorChain())
            ->attach(new NotEmpty())
            ->attach(new StringLength(['max' => 4294967295]));

        return $this->validateChain($chain, $message, 'message');
    }

    /**
     * @param $type
     *
     * @return bool
     */
    public function validateType($type)
    {
        $chain = (new ValidatorChain())
            ->attach(new NotEmpty())
            ->attach(new InArray([
                'haystack'=>[
                    Notification::TYPE_INFO,
                    Notification::TYPE_WARNING
                ]
            ]));

        return $this->validateChain($chain, $type, 'type');
    }

    /**
     * @param $createdAt
     *
     * @return bool
     */
    public function validateCreatedAt($createdAt)
    {
        $chain = (new ValidatorChain())
            ->attach(new NotEmpty())
            ->attach(new IsInstanceOf(\DateTime::class));

        return $this->validateChain($chain, $createdAt, 'createdAt');
    }

    /**
     * @param $status
     *
     * @return bool
     */
    public function validateStatus($status)
    {
        $chain = (new ValidatorChain())
            ->attach(new NotEmpty())
            ->attach(new InArray([
                'haystack'=> [
                    0,
                    Notification::STATUS_READ,
                    Notification::STATUS_ACKNOWLEDGED
                ]
            ]));

        return $this->validateChain($chain, $status, 'status');
    }

    /**
     * @param $action
     *
     * @return bool
     */
    public function validateAction($action)
    {
        $chain = (new ValidatorChain())
            ->attach(new JsonValidator());

        return $this->validateChain($chain, $action, 'action');

    }
}
