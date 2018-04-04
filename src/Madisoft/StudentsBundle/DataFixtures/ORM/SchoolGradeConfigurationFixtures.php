<?php

namespace Madisoft\StudentsBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Madisoft\StudentsBundle\Entity\SchoolGradeConfiguration;

class SchoolGradeConfigurationFixtures extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        /** @var SchoolGradeConfiguration $italian */
        $italian = new SchoolGradeConfiguration();
        $italian->setConfigurationName('Italiano');
        $italian->setGrade(false);
        $italian->setDescription(true);
        $italian->setAverageFlag(false);
        $this->addReference('school_grade_configuration.italian', $italian);
        $manager->persist($italian);

        /** @var SchoolGradeConfiguration $history */
        $history = new SchoolGradeConfiguration();
        $history->setConfigurationName('Storia');
        $history->setGrade(true);
        $history->setDescription(true);
        $history->setAverageFlag(false);
        $this->addReference('school_grade_configuration.history', $history);
        $manager->persist($history);

        /** @var SchoolGradeConfiguration $math */
        $math = new SchoolGradeConfiguration();
        $math->setConfigurationName('Matematica');
        $math->setGrade(true);
        $math->setDescription(true);
        $math->setAverageFlag(true);
        $this->addReference('school_grade_configuration.math', $math);
        $manager->persist($math);

        $manager->flush();
    }
}