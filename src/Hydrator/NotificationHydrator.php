<?php
namespace Fei\Service\Notification\Hydrator;

use Zend\Hydrator\ClassMethods;

/**
 * Class NotificationHydrator
 *
 * @package Fei\Service\Notification\Hydrator
 */
class NotificationHydrator extends ClassMethods
{

    /**
     * @inheritdoc
     */
    public function extract($object)
    {
        $results = parent::extract($object);
        $fields = $object->getEntityFields();

        foreach ($results as $k => &$field) {
            if (!in_array($k, $fields)) {
                unset($results[$k]);
                continue;
            }

            if ($field instanceof \DateTime) {
                $field = $field->format('c');
            }

            if ($k === 'action') {
                $field = json_decode($field, true);
            }
        }

        return $results;
    }

    /**
     * @inheritdoc
     */
    public function hydrate(array $data, $object)
    {
        if (isset($data['created_at']) && is_string($data['created_at'])) {
            $data['created_at'] = new \DateTime($data['created_at']);
        }

        $object = parent::hydrate($data, $object);

        return $object;
    }
}
