<?php
/**
 * PlatformsTransformer.php
 *
 * @date        20/03/18
 * @file        PlatformsTransformer.php
 */

namespace Fei\Service\Notification\Transformer;

use Fei\Service\Notification\Entity\Platforms;
use League\Fractal\TransformerAbstract;

/**
 * PlatformsTransformer
 */
class PlatformsTransformer extends TransformerAbstract
{
    /**
     * @param Platforms $platforms
     *
     * @return array
     */
    public function transform(Platforms $platforms)
    {
        return [
            'id' => $platforms->getId(),
	    'type' => $platforms->getType(),
	    'key' => $platforms->getKey(),
	    'value' => $platforms->getValue(),
	    'updatedat' => $platforms->getUpdatedAt(),
	    'updatedby' => $platforms->getUpdatedBy()
        ];
    }
}
