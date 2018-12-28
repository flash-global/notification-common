<?php

namespace Fei\Service\Notification\Validator\Alert;

use Fei\Service\Notification\Entity\Alert\Rss;
use Fei\Service\Notification\Validator\AbstractValidator;

/**
 * Class RssValidator
 *
 * @package Fei\Service\Notification\Validator\Alert
 */
class RssValidator extends AbstractValidator
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
        if (!$entity instanceof Rss) {
            throw new \Exception(
                sprintf('The Entity to validate must be an instance of %s', Rss::class)
            );
        }

        $errors = $this->getErrors();

        return empty($errors);
    }

}
