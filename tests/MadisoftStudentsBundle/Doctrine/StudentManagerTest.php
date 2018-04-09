<?php

namespace Madisoft\StudentsBundle\Tests\Doctrine;

use Madisoft\StudentsBundle\Entity\Manager\StudentManager;
use Madisoft\StudentsBundle\Entity\Student;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class StudentManagerTest extends WebTestCase
{

    /**
     * @var StudentManager
     */
    private $sm;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $kernel = self::bootKernel();
        $this->sm = $kernel->getContainer()
            ->get(StudentManager::class);
    }

    public function testCalculateGPA()
    {
        /** @var Student $student */
        $student = $this->sm->findStudentByEmail('dibba@5stelle.it');
        $this->assertNotNull($student);
        $this->assertSame($student->getEmail(), 'dibba@5stelle.it');

        $dibbaGPA = $this->sm->calculateGPA($student);
        $this->assertSame($dibbaGPA, 7.0);
    }
}
