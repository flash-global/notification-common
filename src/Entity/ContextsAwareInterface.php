<?php
namespace Fei\Service\Notification\Entity;

/**
 * Interface ContextsAwareInterface
 *
 * @package Fei\Service\Notification\Entity
 */
interface ContextsAwareInterface
{
    /**
     * @param string $context
     * @param mixed $value
     *
     * @return self
     */
    public function setContext($context, $value);

    /**
     * Get a context
     *
     * @param string $context
     * @param string $default
     *
     * @return mixed
     */
    public function getContext($context = null, $default = null);
}
