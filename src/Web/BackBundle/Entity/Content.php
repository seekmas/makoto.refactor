<?php

namespace Web\BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Content
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Content extends Entity
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
     * @ORM\Column(name="subject", type="text")
     */
    private $subject;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="vector", type="string", length=255)
     */
    private $vector;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var string
     *
     * @ORM\Column(name="addon_block_one", type="text" , nullable=true)
     */
    private $addonBlockOne;

    /**
     * @var string
     *
     * @ORM\Column(name="addon_block_two", type="text" , nullable=true)
     */
    private $addonBlockTwo;

    /**
     * @var string
     *
     * @ORM\Column(name="addon_block_three", type="text" , nullable=true)
     */
    private $addonBlockThree;

    /**
     * @ORM\OneToMany(targetEntity="Attachment" , mappedBy="content")
     */
    private $attachment;

    /**
     * @ORM\ManyToOne(targetEntity="Catalog" , inversedBy="content")
     * @ORM\JoinColumn(name="catalog_id" , referencedColumnName="id")
     */
    private $catalog;

    /**
     * @ORM\Column(name="catalog_id" , type="integer" , nullable=true)
     */
    private $catalogId;


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
     * Set subject
     *
     * @param string $subject
     * @return Content
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string 
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Content
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set vector
     *
     * @param string $vector
     * @return Content
     */
    public function setVector($vector)
    {
        $this->vector = $vector;

        return $this;
    }

    /**
     * Get vector
     *
     * @return string 
     */
    public function getVector()
    {
        return $this->vector;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Content
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set addonBlockOne
     *
     * @param string $addonBlockOne
     * @return Content
     */
    public function setAddonBlockOne($addonBlockOne)
    {
        $this->addonBlockOne = $addonBlockOne;

        return $this;
    }

    /**
     * Get addonBlockOne
     *
     * @return string 
     */
    public function getAddonBlockOne()
    {
        return $this->addonBlockOne;
    }

    /**
     * Set addonBlockTwo
     *
     * @param string $addonBlockTwo
     * @return Content
     */
    public function setAddonBlockTwo($addonBlockTwo)
    {
        $this->addonBlockTwo = $addonBlockTwo;

        return $this;
    }

    /**
     * Get addonBlockTwo
     *
     * @return string 
     */
    public function getAddonBlockTwo()
    {
        return $this->addonBlockTwo;
    }

    /**
     * Set addonBlockThree
     *
     * @param string $addonBlockThree
     * @return Content
     */
    public function setAddonBlockThree($addonBlockThree)
    {
        $this->addonBlockThree = $addonBlockThree;

        return $this;
    }

    /**
     * Get addonBlockThree
     *
     * @return string 
     */
    public function getAddonBlockThree()
    {
        return $this->addonBlockThree;
    }

    /**
     * @return mixed
     */
    public function getAttachment()
    {
        return $this->attachment;
    }

    /**
     * @return Content
     * @param mixed $attachment
     */
    public function setAttachment($attachment)
    {
        $this->attachment = $attachment;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCatalog()
    {
        return $this->catalog;
    }

    /**
     * @return Content
     * @param mixed $catalog
     */
    public function setCatalog($catalog)
    {
        $this->catalog = $catalog;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCatalogId()
    {
        return $this->catalogId;
    }

    /**
     * @return Content
     * @param mixed $catalogId
     */
    public function setCatalogId($catalogId)
    {
        $this->catalogId = $catalogId;
        return $this;
    }

    public function __toString()
    {
        return $this->getSubject();
    }
}
