<?php

namespace Web\BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CaseCategory
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class CaseCategory
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="keywords", type="text")
     */
    private $keywords;

    /**
     * @ORM\OneToMany(targetEntity="Cases" , mappedBy="category")
     */
    private $cases;

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
     * Set name
     *
     * @param string $name
     * @return CaseCategory
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set keywords
     *
     * @param string $keywords
     * @return CaseCategory
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;

        return $this;
    }

    /**
     * Get keywords
     *
     * @return string 
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * @return mixed
     */
    public function getCases()
    {
        return $this->cases;
    }

    /**
     * @return CaseCategory
     * @param mixed $cases
     */
    public function setCases($cases)
    {
        $this->cases = $cases;
        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
