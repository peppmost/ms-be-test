<?php

namespace Madisoft\StudentsBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Madisoft\StudentsBundle\Entity\SchoolGrade;

class SchoolGradeFixtures extends AbstractFixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        /** @var SchoolGrade $schoolGrade1 */
        $schoolGrade1 = new SchoolGrade();
        $schoolGrade1->setSchoolSubject($this->getReference('school_subject.italian'));
        $schoolGrade1->setStudent($this->getReference('student.di_maio'));
        $schoolGrade1->setDescription('Deve imparare meglio i congiuntivi');
        $manager->persist($schoolGrade1);

        /** @var SchoolGrade $schoolGrade2 */
        $schoolGrade2 = new SchoolGrade();
        $schoolGrade2->setSchoolSubject($this->getReference('school_subject.italian'));
        $schoolGrade2->setStudent($this->getReference('student.di_maio'));
        $schoolGrade2->setDescription('Molto bene. Si vede che si è impegnato al massimo');
        $manager->persist($schoolGrade2);

        /** @var SchoolGrade $schoolGrade3 */
        $schoolGrade3 = new SchoolGrade();
        $schoolGrade3->setSchoolSubject($this->getReference('school_subject.history'));
        $schoolGrade3->setStudent($this->getReference('student.di_battista'));
        $schoolGrade3->setGrade(8);
        $schoolGrade3->setDescription('Ha sbagliato solo la domanda facoltativa');
        $manager->persist($schoolGrade3);

        /** @var SchoolGrade $schoolGrade4 */
        $schoolGrade4 = new SchoolGrade();
        $schoolGrade4->setSchoolSubject($this->getReference('school_subject.history'));
        $schoolGrade4->setStudent($this->getReference('student.di_battista'));
        $schoolGrade4->setGrade(6);
        $schoolGrade4->setDescription('Appena sufficiente');
        $manager->persist($schoolGrade4);

        /** @var SchoolGrade $schoolGrade5 */
        $schoolGrade5 = new SchoolGrade();
        $schoolGrade5->setSchoolSubject($this->getReference('school_subject.math'));
        $schoolGrade5->setStudent($this->getReference('student.taverna'));
        $schoolGrade5->setGrade(5);
        $schoolGrade5->setDescription('Poteva fare molto meglio');
        $schoolGrade5->setAverageFlag(false);
        $manager->persist($schoolGrade5);

        /** @var SchoolGrade $schoolGrade6 */
        $schoolGrade6 = new SchoolGrade();
        $schoolGrade6->setSchoolSubject($this->getReference('school_subject.math'));
        $schoolGrade6->setStudent($this->getReference('student.taverna'));
        $schoolGrade6->setGrade(2);
        $schoolGrade6->setDescription('Ha copiato il compito da un altro studente');
        $schoolGrade6->setAverageFlag(true);
        $manager->persist($schoolGrade6);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            StudentFixtures::class,
        );
    }
}