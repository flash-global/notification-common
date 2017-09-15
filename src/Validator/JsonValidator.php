<?php
namespace Fei\Service\Notification\Validator;

use Zend\Validator\AbstractValidator;

class JsonValidator extends AbstractValidator
{
    const NOT_JSON = 'notJson';

    /**
     * Validation failure message template definitions
     *
     * @var array
     */
    protected $messageTemplates = [
        self::NOT_JSON => "The input is not as JSON",
    ];

    /**
     * Returns true if $value is as JSON
     *
     * @param  mixed $value
     * @return bool
     */
    public function isValid($value)
    {
        json_decode($value);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->error(self::NOT_JSON);
            return false;
        }

        return true;
    }
}
