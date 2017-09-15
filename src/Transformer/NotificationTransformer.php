<?php
namespace Fei\Service\Notification\Transformer;

use Fei\Service\Notification\Entity\Notification;
use League\Fractal\TransformerAbstract;

/**
 * Class NotificationTransformer
 *
 * @package Fei\Service\Notification\Transformer
 */
class NotificationTransformer extends TransformerAbstract
{
    public function transform(Notification $notification)
    {
        return [
            'id' => $notification->getId(),
            'origin' => $notification->getOrigin(),
            'recipient' => $notification->getRecipient(),
            'event' => $notification->getEvent(),
            'message' => $notification->getMessage(),
            'type' => $notification->getType(),
            'created_at' => $notification->getCreatedAt(),
            'status' => $notification->getStatus(),
            'parent_notification_id' => $notification->getParentNotificationId(),
            'context' => $notification->getContext(),
            'action' => $notification->getAction()
        ];
    }
}
