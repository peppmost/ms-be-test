<?php

namespace Madisoft\StudentsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SchoolSubject
 *
 * @ORM\Table(name="school_subject", indexes={@ORM\Index(name="fk_school_subject_1_idx", columns={"school_grade_configuration_id"})})
 * @ORM\Entity(repositoryClass="\Madisoft\StudentsBundle\Repository\SchoolSubjectRepository")
 */
class SchoolSubject
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=32, nullable=false)
     */
    private $title = '';

    /**
     * @var \Madisoft\StudentsBundle\Entity\SchoolGradeConfiguration
     *
     * @ORM\ManyToOne(targetEntity="SchoolGradeConfiguration")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="school_grade_configuration_id", referencedColumnName="id")
     * })
     */
    private $schoolGradeConfiguration;



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
     * Set title
     *
     * @param string $title
     *
     * @return SchoolSubject
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set schoolGradeConfiguration
     *
     * @param \Madisoft\StudentsBundle\Entity\SchoolGradeConfiguration $schoolGradeConfiguration
     *
     * @return SchoolSubject
     */
    public function setSchoolGradeConfiguration(\Madisoft\StudentsBundle\Entity\SchoolGradeConfiguration $schoolGradeConfiguration = null)
    {
        $this->schoolGradeConfiguration = $schoolGradeConfiguration;

        return $this;
    }

    /**
     * Get schoolGradeConfiguration
     *
     * @return \Madisoft\StudentsBundle\Entity\SchoolGradeConfiguration
     */
    public function getSchoolGradeConfiguration()
    {
        return $this->schoolGradeConfiguration;
    }

    public function __toString()
    {
        return $this->title;
    }
}
