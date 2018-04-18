<?php

namespace Fei\Service\Notification\Transformer\Alert\Android;

use Fei\Service\Notification\Entity\Alert\Android;
use League\Fractal\TransformerAbstract;

/**
 * NotificationTransformer
 */
class NotificationTransformer extends TransformerAbstract
{
    /**
     * @param Android\Notification $notification
     * @return array
     */
    public function transform(Android\Notification $notification)
    {
        return [
            'title' => $notification->getTitle(),
            'body' => $notification->getBody()
        ];
    }
}