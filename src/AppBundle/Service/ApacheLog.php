<?php

namespace AppBundle\Service;

use AppBundle\Entity\AccessLog;
use AppBundle\Service\ApacheLog\Access;
use AppBundle\Traits\DoctrineTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class ApacheLog
 * @package AppBundle\Service
 */
class ApacheLog
{
    use DoctrineTrait;

    /** @var ContainerInterface */
    protected $container;

    /**
     * ApacheLog constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @return Access
     */
    public function getAccess(): Access
    {
        return new Access();
    }

    /**
     * @param AccessLog $accessLog
     */
    public function preventDdosAccessLog(AccessLog $accessLog)
    {
        $find = $this->getDoctrineManager()->getRepository('AppBundle:AccessLog')->findBy([
            'time' => $accessLog->getTime(),
            'host' => $accessLog->getHost(),
            'user' => $accessLog->getUser(),
        ]);
        if (10 < \count($find)) {
            // DDOS ALARM
        }
    }
}
