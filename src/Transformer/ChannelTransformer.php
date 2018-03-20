<?php
/**
 * ChannelTransformer.php
 *
 * @date        20/03/18
 * @file        ChannelTransformer.php
 */

namespace Fei\Service\Notification\Transformer;

use Fei\Service\Notification\Entity\Channel;
use League\Fractal\TransformerAbstract;

/**
 * ChannelTransformer
 */
class ChannelTransformer extends TransformerAbstract
{
    /**
     * @param Channel $channel
     *
     * @return array
     */
    public function transform(Channel $channel)
    {
        return [
            'id' => $channel->getId(),
            'name' => $channel->getName(),
        ];
    }
}