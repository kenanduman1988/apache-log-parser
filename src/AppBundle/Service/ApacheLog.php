<?php

namespace AppBundle\Service;

use AppBundle\Service\ApacheLog\Access;

/**
 * Class ApacheLog
 * @package AppBundle\Service
 */
class ApacheLog
{
    /**
     * @return Access
     */
    public function getAccess($format = null): Access
    {
        return new Access($format);
    }
}
