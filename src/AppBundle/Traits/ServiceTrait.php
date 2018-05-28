<?php

namespace AppBundle\Traits;

use AppBundle\Service\ApacheLog;

/**
 * Trait ServiceTrait
 * @package AppBundle\Traits
 */
trait ServiceTrait
{
    /**
     * @return ApacheLog
     */
    public function getApacheLogService()
    {
        return $this->container->get('apachelog');
    }
}