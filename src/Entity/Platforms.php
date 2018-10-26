<?php

namespace Fei\Service\Notification\Entity;

use Fei\Entity\AbstractEntity;

/**
 * Class Platforms
 *
 * @Entity
 * @Table(name="platforms")
 *
 * @package Fei\Service\Notification\Entity
 */
class Platforms extends AbstractEntity
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
     * @var integer
     *
     * @Column(type="string", name="`type`")
     */
    protected $type;

    /**
     * @var string
     *
     * @Column(type="string", name="`key`")
     * */
    protected $key;

    /**
     * @var string
     *
     * @Column(type="string", name="`value`")
     * */
    protected $value;

    /**
     * @var \DateTime
     *
     * @Column(type="datetime", name="`updated_at`")
     * */
    protected $updatedAt;

    /**
     * @var string
     *
     * @Column(type="string", name="`updated_by`")
     * */
    protected $updatedBy;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Platforms
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $platformType
     * @return Platforms
     */
    public function setType($platformType)
    {
        $this->type = $platformType;
        return $this;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string $key
     * @return Platforms
     */
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return Platforms
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param string $updatedAt
     * @return Platforms
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return string
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * @param string $updatedBy
     * @return Platforms
     */
    public function setUpdatedBy($updatedBy)
    {
        $this->updatedBy = $updatedBy;
        return $this;
    }
}
