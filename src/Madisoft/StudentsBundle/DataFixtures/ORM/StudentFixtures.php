<?php

namespace Madisoft\StudentsBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Madisoft\StudentsBundle\Entity\Student;

class StudentFixtures extends AbstractFixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        /** @var Student $diMaio */
        $diMaio = new Student();
        $diMaio->setFirstname('Luigi');
        $diMaio->setLastname('Di Maio');
        $diMaio->setEmail('dimaioluigi@5stelle.it');
        $diMaio->setSchoolSubject($this->getReference('school_subject.italian'));
        $this->addReference('student.di_maio', $diMaio);
        $manager->persist($diMaio);

        /** @var Student $diBattista */
        $diBattista = new Student();
        $diBattista->setFirstname('Alessandro');
        $diBattista->setLastname('Di Battista');
        $diBattista->setEmail('dibba@5stelle.it');
        $diBattista->setSchoolSubject($this->getReference('school_subject.history'));
        $this->addReference('student.di_battista', $diBattista);
        $manager->persist($diBattista);

        /** @var Student $taverna */
        $taverna = new Student();
        $taverna->setFirstname('Paola');
        $taverna->setLastname('Taverna');
        $taverna->setEmail('taverna@5stelle.it');
        $taverna->setSchoolSubject($this->getReference('school_subject.math'));
        $this->addReference('student.taverna', $taverna);
        $manager->persist($taverna);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            SchoolSubjectFixtures::class,
        );
    }
}