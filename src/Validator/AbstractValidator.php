<?php
namespace Fei\Service\Notification\Validator;

use Zend\Validator\ValidatorChain;

/**
 * Class AbstractValidator
 *
 * @package Shaq\Common\Validator
 */
abstract class AbstractValidator
{
    /**
     * @var array
     */
    protected $errors = array();

    abstract public function validate($entity);

    /**
     * Validate a Validation Chain
     *
     * @param ValidatorChain $chain
     * @param mixed          $value
     * @param string         $attribute
     *
     * @return bool
     */
    public function validateChain(ValidatorChain $chain, $value, $attribute)
    {
        if (!$chain->isValid($value)) {
            foreach ($chain->getMessages() as $message) {
                $this->addError($attribute, $message);
            }

            return false;
        }

        return true;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param string $attribute
     * @param string $message
     *
     * @return $this
     */
    public function addError($attribute, $message)
    {
        $this->errors[$attribute][] = $message;

        return $this;
    }

    /**
     * @return $this
     */
    protected function clearErrors()
    {
        $this->errors = array();

        return $this;
    }

    /**
     * @return string
     */
    public function getErrorsAsString()
    {
        $errors = array();
        foreach ($this->getErrors() as $attribute => $attrErrors)
        {
            $errors[] = $attribute . ': ' . implode(', ', $attrErrors);
        }

        return implode('; ', $errors);
    }
}
