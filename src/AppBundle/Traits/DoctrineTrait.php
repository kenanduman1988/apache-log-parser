<?php

namespace AppBundle\Traits;

/**
 * Trait DoctrineTrait
 * @package AppBundle\Traits
 */
trait DoctrineTrait
{
    /**
     *
     * @return \Doctrine\Common\Persistence\ObjectManager
     */
    protected function getDoctrineManager()
    {
        return $this->container->get('doctrine')->getManager();
    }

    /**
     * @param $object
     * @return mixed
     */
    protected function persistDoctrineManager($object)
    {
        return $this->container->get('doctrine')->getManager()->persist($object);
    }

    /**
     * @return mixed
     */
    protected function flushDoctrineManager()
    {
        return $this->container->get('doctrine')->getManager()->flush();
    }

    /**
     * @return mixed
     */
    protected function clearDoctrineManager()
    {
        return $this->container->get('doctrine')->getManager()->clear();
    }
}