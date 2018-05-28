<?php

namespace AppBundle\Service\ApacheLog;

use AppBundle\Entity\AccessLog;

/**
 * Class Access
 * @package AppBundle\Service\ApacheLog
 */
class Access extends AbstractLog implements ApacheLogInterface
{
    /** @var string */
    protected $defaultFormat = '%h %l %u %t "%r" %>s %b';

    /**
     * @param $line
     * @return AccessLog
     * @throws \Exception
     */
    public function getEntity(string $line): AccessLog
    {
        if (!preg_match($this->getPcreFormat(), $line, $matches)) {
            throw new \Exception('Format not match');
        }
        $entity = new AccessLog();
        $entity
            ->setHost($matches['host'])
            ->setLogName($matches['logname'])
            ->setUser($matches['user'])
            ->setTime($matches['time'])
            ->setRequest($matches['request'])
            ->setStatus($matches['status'])
            ->setResponseBytes($matches['responseBytes']);

        return $entity;
    }
}