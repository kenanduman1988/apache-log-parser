<?php

namespace AppBundle\Traits;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Trait ContainerTrait
 * @package ApiBundle\Traits
 */
trait ContainerTrait
{
    use ServiceTrait;

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     * @return $this
     */
    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
        return $this;
    }
}
