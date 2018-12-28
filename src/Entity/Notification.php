<?php
namespace Fei\Service\Notification\Entity;

use ObjectivePHP\Gateway\Entity\Entity as ObjectiveEntity;

/**
 * Class Notification
 *
 * @package Fei\Service\Notification\Entity
 */
class Notification extends ObjectiveEntity implements ContextsAwareInterface
{
    const TYPE_INFO = 1;
    const TYPE_WARNING = 2;

    const STATUS_READ = 1;
    const STATUS_ACKNOWLEDGED = 2;

    /** @var integer */
    protected $id;

    /** @var string */
    protected $origin;

    /**
     * Represent the Connect username of the user
     *
     * @var string
     */
    protected $recipient;

    /** @var string */
    protected $event;

    /** @var string */
    protected $message;

    /** @var integer */
    protected $type;

    /** @var \DateTime */
    protected $createdAt;

    /** @var integer */
    protected $status = 0;

    /** @var int */
    protected $parentNotificationId;

    /** @var array */
    protected $context = [];

    /** @var string */
    protected $action = '{}';

    /**
     * Notification constructor.
     *
     * @param array  $input
     * @param int    $flags
     * @param string $iteratorClass
     */
    public function __construct($input = [], $flags = 0, $iteratorClass = "ArrayIterator")
    {
        parent::__construct($input, $flags, $iteratorClass);

        if (empty($input['createdAt'])) {
            $this->setCreatedAt((new \DateTime())->format('Y-m-d H:i'));
        }
    }

    /**
     * Get Id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set Id
     *
     * @param int $id
     *
     * @return self
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get Origin
     *
     * @return string
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * Set Origin
     *
     * @param string $origin
     *
     * @return self
     */
    public function setOrigin($origin): self
    {
        $this->origin = $origin;

        return $this;
    }

    /**
     * Get Recipient
     *
     * @return string
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * Set Recipient
     *
     * @param string $recipient
     *
     * @return self
     */
    public function setRecipient($recipient): self
    {
        $this->recipient = $recipient;

        return $this;
    }

    /**
     * Get Event
     *
     * @return string
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Set Event
     *
     * @param string $event
     *
     * @return self
     */
    public function setEvent($event): self
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get Message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set Message
     *
     * @param string $message
     *
     * @return self
     */
    public function setMessage($message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get Type
     *
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set Type
     *
     * @param int $type
     *
     * @return self
     */
    public function setType($type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get CreatedAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set CreatedAt
     *
     * @param $createdAt
     *
     * @return self
     */
    public function setCreatedAt($createdAt): self
    {
        if (is_string($createdAt)) {
            $createdAt = (new \DateTime($createdAt))->format('Y-m-d H:i');
        }

        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     *
     * @return self
     */
    public function setStatus($status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return int
     */
    public function getParentNotificationId()
    {
        return $this->parentNotificationId;
    }

    /**
     * @param $parentNotificationId
     *
     * @return self
     */
    public function setParentNotificationId(int $parentNotificationId = null): self
    {
        $this->parentNotificationId = $parentNotificationId;

        return $this;
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param string $action
     *
     * @return self
     */
    public function setAction($action): self
    {
        if (is_array($action)) {
            $action = json_encode($action);
        }

        $this->action = $action;

        return $this;
    }

    /**
     * @return string
     */
    public function getEntityCollection() : string
    {
        return 'notifications';
    }

    /**
     * @inheritdoc
    */
    public function setContext($context, $value = null)
    {
        if ($value === null && is_array($context)) {
            $this->context = $context;

            return $this;
        }

        $this->context[$context] = $value;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getContext($context = null, $default = null)
    {
        if (null === $context) {
            return $this->context;
        }

        return $this->context[$context] ?? $default;
    }
}
