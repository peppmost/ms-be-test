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

    public function __construct(EntityManager $em, $class) {
        $this->em = $em;
        $this->class = $class;
        $this->repository = $em->getRepository($class);
    }

    public function getClass()
    {
        return $this->class;
    }

    public function getRepository()
    {
        return $this->repository;
    }

    public function getEm()
    {
        return $this->getEm();
    }

    public function save($object)
    {
        $this->em->persist($object);
        $this->em->flush();
        return $object;
    }

    public function getEntityFields()
    {
        return $this->em->getClassMetadata($this->class);
    }
}