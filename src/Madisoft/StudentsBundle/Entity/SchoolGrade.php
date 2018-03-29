<?php

namespace Madisoft\StudentsBundle\Entity;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * SchoolGrade
 *
 * @ORM\Table(name="school_grade", indexes={@ORM\Index(name="student_id", columns={"student_id"}), @ORM\Index(name="school_subject_id", columns={"school_subject_id"})})
 * @ORM\Entity(repositoryClass="\Madisoft\StudentsBundle\Repository\SchoolGradeRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class SchoolGrade
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="grade", type="integer", nullable=true)
     *
     * @Assert\Type("integer")
     * @Assert\Range(
     *      min = 1,
     *      max = 10
     *  )
     */
    private $grade;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     *
     */
    private $description;

    /**
     * @var boolean
     *
     * @ORM\Column(name="average_flag", type="boolean", nullable=true)
     */
    private $averageFlag;

    /**
     * @var datetime $createdAt
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return datetime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param datetime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @var datetime $createdAt
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updatedAt;


    /**
     * @var \Madisoft\StudentsBundle\Entity\Student
     *
     * @ORM\ManyToOne(targetEntity="Student")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="student_id", referencedColumnName="id")
     * })
     */
    private $student;

    /**
     * @var \Madisoft\StudentsBundle\Entity\SchoolSubject
     *
     * @ORM\ManyToOne(targetEntity="SchoolSubject", inversedBy="schoolGrades")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="school_subject_id", referencedColumnName="id")
     * })
     */
    private $schoolSubject;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set grade
     *
     * @param integer $grade
     *
     * @return SchoolGrade
     */
    public function setGrade($grade)
    {
        $this->grade = $grade;

        return $this;
    }

    /**
     * Get grade
     *
     * @return integer
     */
    public function getGrade()
    {
        return $this->grade;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return SchoolGrade
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set averageFlag
     *
     * @param boolean $averageFlag
     *
     * @return SchoolGrade
     */
    public function setAverageFlag($averageFlag)
    {
        $this->averageFlag = $averageFlag;

        return $this;
    }

    /**
     * Get averageFlag
     *
     * @return boolean
     */
    public function getAverageFlag()
    {
        return $this->averageFlag;
    }

    /**
     * Set student
     *
     * @param \Madisoft\StudentsBundle\Entity\Student $student
     *
     * @return SchoolGrade
     */
    public function setStudent(\Madisoft\StudentsBundle\Entity\Student $student = null)
    {
        $this->student = $student;

        return $this;
    }

    /**
     * Get student
     *
     * @return \Madisoft\StudentsBundle\Entity\Student
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * Set schoolSubject
     *
     * @param \Madisoft\StudentsBundle\Entity\SchoolSubject $schoolSubject
     *
     * @return SchoolGrade
     */
    public function setSchoolSubject(\Madisoft\StudentsBundle\Entity\SchoolSubject $schoolSubject = null)
    {
        $this->schoolSubject = $schoolSubject;

        return $this;
    }

    /**
     * Get schoolSubject
     *
     * @return \Madisoft\StudentsBundle\Entity\SchoolSubject
     */
    public function getSchoolSubject()
    {
        return $this->schoolSubject;
    }


    //Life Cycle Callbacks

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     * @param LifecycleEventArgs $eventArgs
     * @return $this
     */
    public function createAndUpdateDates(LifecycleEventArgs $eventArgs)
    {
        $date = new \DateTime('now');

        if($this->getCreatedAt() == null){
            $this->setCreatedAt($date);
        }
        $this->setUpdatedAt($date);

        $schoolGradeConfiguration = $this->getStudent()->getSchoolSubject()->getSchoolGradeConfiguration();
        if($schoolGradeConfiguration->getGrade() && !$schoolGradeConfiguration->getAverageFlag()){

            $this->setAverageFlag(true);
        }

        return $this;
    }
}
