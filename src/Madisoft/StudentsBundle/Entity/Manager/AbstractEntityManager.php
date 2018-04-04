<?php

namespace Madisoft\StudentsBundle\Entity\Manager;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * Class AbstractObjectManager.
 *
 * Abstract Object Manager: Base entity operations.
 */
abstract class AbstractEntityManager
{
    protected $em;

    protected $repository;

    protected $class;

    /**
     * AbstractEntityManager constructor.
     * @param EntityManager $em
     * @param $class
     */
    public function __construct(EntityManager $em, $class) {
        $this->em = $em;
        $this->class = $class;
        $this->repository = $em->getRepository($class);
    }

    /**
     * @return mixed
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @return EntityRepository
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * @return mixed
     */
    public function getEm()
    {
        return $this->getEm();
    }

    /**
     * @param $object
     * @return mixed
     */
    public function save($object)
    {
        $this->em->persist($object);
        $this->em->flush();
        return $object;
    }

    /**
     * @return \Doctrine\ORM\Mapping\ClassMetadata
     */
    public function getEntityFields()
    {
        return $this->em->getClassMetadata($this->class);
    }
}