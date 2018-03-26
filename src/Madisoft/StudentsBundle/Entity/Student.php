<?php

namespace Madisoft\StudentsBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Student
 *
 * @ORM\Table(name="student", indexes={@ORM\Index(name="school_subject_id", columns={"school_subject_id"})})
 * @ORM\Entity(repositoryClass="\Madisoft\StudentsBundle\Repository\StudentRepository")
 */
class Student
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=64, nullable=false)
     *
     * @Assert\NotBlank()
     */
    private $firstname = '';

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=64, nullable=false)
     *
     * @Assert\NotBlank()
     */
    private $lastname = '';

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=128, nullable=false)
     *
     * @Assert\Email()
     */
    private $email;

    /**
     * @var \Madisoft\StudentsBundle\Entity\SchoolSubject
     *
     * @ORM\ManyToOne(targetEntity="SchoolSubject")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="school_subject_id", referencedColumnName="id")
     * })
     *
     * @Assert\NotBlank()
     */
    private $schoolSubject;

    /**
     * @var ArrayCollection
     *
     * @Assert\Valid
     * @ORM\OneToMany(targetEntity="SchoolGrade", mappedBy="student", cascade={"persist"}, orphanRemoval=true)
     * @ORM\OrderBy({"updatedAt" = "ASC"})
     */
    private $schoolGrades;

    public function __construct()
    {
        $this->schoolGrades = new ArrayCollection();
    }

    /**
     * @return SchoolGrade
     */
    public function getSchoolGrades()
    {
        return $this->schoolGrades;
    }

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
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Student
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Student
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Student
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set schoolSubject
     *
     * @param \Madisoft\StudentsBundle\Entity\SchoolSubject $schoolSubject
     *
     * @return Student
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

    public function addSchoolGrade(SchoolGrade $schoolGrade)
    {
        if ($this->schoolGrades->contains($schoolGrade)) {
            return;
        }
        $this->schoolGrades[] = $schoolGrade;
        $schoolGrade->setStudent($this);
        $schoolGrade->setSchoolSubject($this->getSchoolSubject());
    }

    public function removeSchoolGrade(SchoolGrade $schoolGrade)
    {
        if (!$this->marks->contains($schoolGrade)) {
            return;
        }
        $this->schoolGrades->removeElement($schoolGrade);
    }

    public function __toString()
    {
        return $this->lastname . ' ' . $this->firstname;
    }
}
