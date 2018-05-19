<?php

namespace AppBundle\Service\ApacheLog;

/**
 * Interface ApacheLogInterface
 * @package AppBundle\Service\ApacheLog
 */
interface ApacheLogInterface
{
    /**
     * @return void
     */
    public function setIpPatterns();

    /**
     * @param string $format
     */
    public function setFormat(string $format = null);
}
