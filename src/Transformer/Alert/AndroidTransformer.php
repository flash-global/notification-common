<?php

namespace Fei\Service\Notification\Transformer\Alert;

use Fei\Service\Notification\Entity\Alert\Android;
use Fei\Service\Notification\Transformer\Alert\Android\MessageTransformer;
use League\Fractal\TransformerAbstract;

/**
 * AndroidTransformer
 */
class AndroidTransformer extends TransformerAbstract
{
    /**
     * @param Android $android
     * @return array
     */
    public function transform(Android $android)
    {
        $messageTransformer = new MessageTransformer();
        
        return [
            'message' => $messageTransformer->transform($android->getMessage()),
        ];
    }
}
