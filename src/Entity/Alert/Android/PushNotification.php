<?php


namespace Fei\Service\Notification\Entity\Alert\Android;

/**
 * Class PushNotification
 *
 * https://firebase.google.com/docs/cloud-messaging/http-server-ref#notification-payload-support
 *
 * @package Fei\Service\Notification\Entity\Alert\Android
 */
class PushNotification extends AbstractAndroid
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
     * @var string
     */
    protected $androidChannelId;

    /**
     * @var string
     */
    protected $icon;

    /**
     * @var string
     */
    protected $sound;

    /**
     * @var string
     */
    protected $tag;

    /**
     * format #rrggbb
     *
     * @var string
     */
    protected $color;

    /**
     * @var string
     */
    protected $clickAction;

    /**
     * @var string
     */
    protected $bodyLocKey;

    /**
     * format JSON array as String
     *
     * @var array
     */
    protected $bodyLocArgs;

    /**
     * @var string
     */
    protected $titleLocKey;

    /**
     * format JSON array as String
     *
     * @var array
     */
    protected $titleLocArgs;

    /**
     * Get Title
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set Title
     *
     * @param string $title
     *
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Get Body
     *
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * Set Body
     *
     * @param string $body
     *
     * @return $this
     */
    public function setBody(string $body): self
    {
        $this->body = $body;
        return $this;
    }

    /**
     * Get AndroidChannelId
     *
     * @return string
     */
    public function getAndroidChannelId(): string
    {
        return $this->androidChannelId;
    }

    /**
     * Set AndroidChannelId
     *
     * @param string $androidChannelId
     *
     * @return $this
     */
    public function setAndroidChannelId(string $androidChannelId):self
    {
        $this->androidChannelId = $androidChannelId;
        return $this;
    }

    /**
     * Get Icon
     *
     * @return string
     */
    public function getIcon(): string
    {
        return $this->icon;
    }

    /**
     * Set Icon
     *
     * @param string $icon
     *
     * @return $this
     */
    public function setIcon(string $icon): self
    {
        $this->icon = $icon;
        return $this;
    }

    /**
     * Get Sound
     *
     * @return string
     */
    public function getSound(): string
    {
        return $this->sound;
    }

    /**
     * Set Sound
     *
     * @param string $sound
     *
     * @return $this
     */
    public function setSound(string $sound): self
    {
        $this->sound = $sound;
        return $this;
    }

    /**
     * Get Tag
     *
     * @return string
     */
    public function getTag(): string
    {
        return $this->tag;
    }

    /**
     * Set Tag
     *
     * @param string $tag
     *
     * @return $this
     */
    public function setTag(string $tag): self
    {
        $this->tag = $tag;
        return $this;
    }

    /**
     * Get Color
     *
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * Set Color
     *
     * @param string $color
     *
     * @return $this
     */
    public function setColor(string $color): self
    {
        $this->color = $color;
        return $this;
    }

    /**
     * Get ClickAction
     *
     * @return string
     */
    public function getClickAction(): string
    {
        return $this->clickAction;
    }

    /**
     * Set ClickAction
     *
     * @param string $clickAction
     *
     * @return $this
     */
    public function setClickAction(string $clickAction): self
    {
        $this->clickAction = $clickAction;
        return $this;
    }

    /**
     * Get BodyLocKey
     *
     * @return string
     */
    public function getBodyLocKey(): string
    {
        return $this->bodyLocKey;
    }

    /**
     * Set BodyLocKey
     *
     * @param string $bodyLocKey
     *
     * @return $this
     */
    public function setBodyLocKey(string $bodyLocKey): self
    {
        $this->bodyLocKey = $bodyLocKey;
        return $this;
    }

    /**
     * Get BodyLocArgs
     *
     * @return array
     */
    public function getBodyLocArgs(): array
    {
        return $this->bodyLocArgs;
    }

    /**
     * Set BodyLocArgs
     *
     * @param array $bodyLocArgs
     *
     * @return $this
     */
    public function setBodyLocArgs(array $bodyLocArgs): self
    {
        $this->bodyLocArgs = $bodyLocArgs;
        return $this;
    }

    /**
     * Get TitleLocKey
     *
     * @return string
     */
    public function getTitleLocKey(): string
    {
        return $this->titleLocKey;
    }

    /**
     * Set TitleLocKey
     *
     * @param string $titleLocKey
     *
     * @return $this
     */
    public function setTitleLocKey(string $titleLocKey): self
    {
        $this->titleLocKey = $titleLocKey;
        return $this;
    }

    /**
     * Get TitleLocArgs
     *
     * @return array
     */
    public function getTitleLocArgs(): array
    {
        return $this->titleLocArgs;
    }

    /**
     * Set TitleLocArgs
     *
     * @param array $titleLocArgs
     *
     * @return $this
     */
    public function setTitleLocArgs(array $titleLocArgs): self
    {
        $this->titleLocArgs = $titleLocArgs;
        return $this;
    }

    /**
     * Build an array which contains all value possible for a notification fcm :
     * https://firebase.google.com/docs/cloud-messaging/http-server-ref#notification-payload-support
     *
     * @return array
     */
    public function buildArray(): array
    {
        $data = [];
        $vars = get_object_vars($this);

        foreach ($vars as $var => $value) {
            if (!empty($value)) {
                $attr = $this->toSnakeCase($var);
                $data[$attr] = $value;
            }
        }

        return $data;
    }
}