<?php

namespace Fei\Service\Notification\Entity\Alert\Android;

use Fei\Entity\AbstractEntity;

class Notification extends AbstractEntity
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $body;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Notification
     */
    public function setTitle(string $title): Notification
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     * @return Notification
     */
    public function setBody(string $body): Notification
    {
        $this->body = $body;
        return $this;
    }


}