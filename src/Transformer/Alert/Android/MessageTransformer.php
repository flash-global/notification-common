<?php

namespace Fei\Service\Notification\Transformer\Alert\Android;

use Fei\Service\Notification\Entity\Alert\Android;
use League\Fractal\TransformerAbstract;

/**
 * MessageTransformer
 */
class MessageTransformer extends TransformerAbstract
{
    /**
     * @param Android\Message $message
     * @return array
     */
    public function transform(Android\Message $message)
    {
        $notificationTransformer = new NotificationTransformer();

        $return = [
            'notification' => $notificationTransformer->transform($message->getNotification()),
        ];

        if (!empty($message->getData())) {
            $return['data'] = $message->getData();
        }

        if (!empty($message->getCondition())) {
            $return['condition'] = $message->getCondition();
        }

        if (!empty($message->getTopic())) {
            $return['topic'] = $message->getTopic();
        }

        if (!empty($message->getToken())) {
            $return['token'] = $message->getToken();
        }

        return $return;
    }
}