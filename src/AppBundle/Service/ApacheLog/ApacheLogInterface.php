<?php

namespace AppBundle\Service\ApacheLog;

/**
 * Interface ApacheLogInterface
 * @package AppBundle\Service\ApacheLog
 */
interface ApacheLogInterface
{
    /**
     * @return object
     */
    public function setIpPatterns(): object;

    /**
     * @param string $format
     */
    public function setFormat(string $format = null): void;

    /**
     * @param $line
     * @return object
     * @throws \Exception
     */
    public function getEntity(string $line): object;
}
