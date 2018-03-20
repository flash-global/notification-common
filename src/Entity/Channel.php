<?php
/**
 * Channel.php
 *
 * @date        20/03/18
 * @file        Channel.php
 */

namespace Fei\Service\Notification\Entity;

use ObjectivePHP\Gateway\Entity\Entity;

/**
 * Channel
 */
class Channel extends Entity
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $name;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return $this
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
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}