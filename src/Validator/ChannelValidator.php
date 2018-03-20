<?php
/**
 * ChannelValidator.php
 *
 * @date        20/03/18
 * @file        ChannelValidator.php
 */

namespace Fei\Service\Notification\Validator;

use Fei\Service\Notification\Entity\Channel;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;
use Zend\Validator\ValidatorChain;

/**
 * ChannelValidator
 */
class ChannelValidator extends AbstractValidator
{
    /**
     * @param $entity
     *
     * @return bool
     * @throws \Exception
     */
    public function validate($entity)
    {
        if (!$entity instanceof Channel) {
            throw new \Exception(
                sprintf('The Entity to validate must be an instance of %s', Channel::class)
            );
        }

        $this->validateName($entity->getName());

        $errors = $this->getErrors();

        return empty($errors);
    }

    /**
     * @param $name
     *
     * @return bool
     */
    public function validateName($name)
    {
        $chain = (new ValidatorChain())
            ->attach(new NotEmpty())
            ->attach(new StringLength(['max' => 45]));

        return $this->validateChain($chain, $name, 'name');
    }
}