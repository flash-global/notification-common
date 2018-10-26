<?php
/**
 * PlatformsValidator.php
 *
 * @date        20/03/18
 * @file        PlatformsValidator.php
 */

namespace Fei\Service\Notification\Validator;

use Fei\Service\Notification\Entity\Platforms;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;
use Zend\Validator\ValidatorChain;

/**
 * PlatformsValidator
 */
class PlatformsValidator extends AbstractValidator
{
    /**
     * @param $entity
     *
     * @return bool
     * @throws \Exception
     */
    public function validate($entity)
    {
        if (!$entity instanceof Platforms) {
            throw new \Exception(
                sprintf('The Entity to validate must be an instance of %s', Platforms::class)
            );
        }

        $this->validateType($entity->getType());

        $errors = $this->getErrors();

        return empty($errors);
    }

    /**
     * @param $name
     *
     * @return bool
     */
    public function validateType($type)
    {
        $chain = (new ValidatorChain())
            ->attach(new NotEmpty())
            ->attach(new StringLength(['max' => 45]));

        return $this->validateChain($chain, $type, 'type');
    }
}
