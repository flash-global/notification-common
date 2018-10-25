<?php

namespace Fei\Service\Notification\Entity;

use Fei\Entity\AbstractEntity;

/**
 * Class NotificationPlatform
 *
 * @Entity
 * @Table(name="notification_platforms")
 *
 * @package Fei\Service\Notification\Entity
 */
class NotificationPlatform extends AbstractEntity
{
    /**
     * @var int
     *
     * @Id
     * @GeneratedValue(strategy="AUTO")
     * @Column(type="integer")
     */
    protected $id;

    /**
     * @var string
     *
     * @Column(type="string", name="`name`")
     */
    protected $name;

    /**
     * @var bool
     *
     * @Column(type="boolean", name="`enabled`")
     */
    protected $enabled;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return NotificationPlatform
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return NotificationPlatform
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     * @return NotificationPlatform
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
        return $this;
    }
}
