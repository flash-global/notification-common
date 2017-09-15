<?php

namespace Fei\Service\Notification\Entity\Alert\Android;

use Fei\Entity\AbstractEntity;

/**
 * Class AbstractAndroid
 *
 * @package Fei\Service\Notification\Entity\Alert\Android
 */
abstract class AbstractAndroid extends AbstractEntity
{
    /**
     * Format an object to return an array
     * @return array
     */
    abstract public function buildArray() : array;
}
