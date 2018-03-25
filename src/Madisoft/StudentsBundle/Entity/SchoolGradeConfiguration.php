<?php

namespace Madisoft\StudentsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SchoolGradeConfiguration
 *
 * @ORM\Table(name="school_grade_configuration")
 * @ORM\Entity(repositoryClass="\Madisoft\StudentsBundle\Repository\SchoolGradeConfigurationRepository")
 */
class SchoolGradeConfiguration
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
     * @var boolean
     *
     * @ORM\Column(name="grade", type="boolean", nullable=false)
     */
    private $grade = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="description", type="boolean", nullable=false)
     */
    private $description = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="average_flag", type="boolean", nullable=false)
     */
    private $averageFlag = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="configuration_name", type="string", length=45, nullable=false)
     */
    private $configurationName;



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
     * @param boolean $grade
     *
     * @return SchoolGradeConfiguration
     */
    public function setGrade($grade)
    {
        $this->grade = $grade;

        return $this;
    }

    /**
     * Get grade
     *
     * @return boolean
     */
    public function getGrade()
    {
        return $this->grade;
    }

    /**
     * Set description
     *
     * @param boolean $description
     *
     * @return SchoolGradeConfiguration
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return boolean
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
     * @return SchoolGradeConfiguration
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
     * Set configurationName
     *
     * @param string $configurationName
     *
     * @return SchoolGradeConfiguration
     */
    public function setConfigurationName($configurationName)
    {
        $this->configurationName = $configurationName;

        return $this;
    }

    /**
     * Get configurationName
     *
     * @return string
     */
    public function getConfigurationName()
    {
        return $this->configurationName;
    }
}
