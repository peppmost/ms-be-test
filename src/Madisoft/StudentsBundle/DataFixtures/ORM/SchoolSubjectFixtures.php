<?php

namespace Madisoft\StudentsBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Madisoft\StudentsBundle\Entity\SchoolSubject;

class SchoolSubjectFixtures extends AbstractFixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        /** @var SchoolSubject $italian */
        $italian = new SchoolSubject();
        $italian->setTitle('Italiano');
        $italian->setSchoolGradeConfiguration($this->getReference('school_grade_configuration.italian'));
        $this->addReference('school_subject.italian', $italian);
        $manager->persist($italian);

        /** @var SchoolSubject $history */
        $history = new SchoolSubject();
        $history->setTitle('Storia');
        $history->setSchoolGradeConfiguration($this->getReference('school_grade_configuration.history'));
        $this->addReference('school_subject.history', $history);
        $manager->persist($history);

        /** @var SchoolSubject $math */
        $math = new SchoolSubject();
        $math->setTitle('Matematica');
        $math->setSchoolGradeConfiguration($this->getReference('school_grade_configuration.math'));
        $this->addReference('school_subject.math', $math);
        $manager->persist($math);

        $manager->flush();
    }

    /**
     * @return array
     */
    public function getDependencies()
    {
        return array(
            SchoolGradeConfigurationFixtures::class,
        );
    }
}