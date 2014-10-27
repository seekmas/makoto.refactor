<?php

namespace Web\BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Attachment
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Attachment extends Entity
{

    /**
     * @ORM\Column(type="guid")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="file", type="string", length=255)
     */
    private $file;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="text")
     */
    private $path;

    /**
     * @ORM\Column(name="mime" , type="string" , length=255)
     */
    private $mime;
    /**
     * @var string
     *
     * @ORM\Column(name="md5", type="string", length=255)
     */
    private $md5;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="Content" , inversedBy="attachment")
     * @ORM\JoinColumn(name="content_id" , referencedColumnName="id")
     */
    private $content;

    /**
     * @ORM\Column(name="content_id" , type="integer" , nullable=true)
     */
    private $contentId;

    /**
     * @ORM\ManyToOne(targetEntity="Newsfeed" , inversedBy="attachment" , cascade={"persist"})
     * @ORM\JoinColumn(name="newsfeed_id" , referencedColumnName="id")
     */
    private $newsfeed;

    /**
     * @ORM\Column(name="newsfeed_id" , type="integer" , nullable=true)
     */
    private $newsfeedId;

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
     * Set file
     *
     * @param string $file
     * @return Attachment
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Attachment
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return mixed
     */
    public function getMime()
    {
        return $this->mime;
    }

    /**
     * @return Attachment
     * @param mixed $mime
     */
    public function setMime($mime)
    {
        $this->mime = $mime;
        return $this;
    }

    /**
     * Set md5
     *
     * @param string $md5
     * @return Attachment
     */
    public function setMd5($md5)
    {
        $this->md5 = $md5;

        return $this;
    }

    /**
     * Get md5
     *
     * @return string
     */
    public function getMd5()
    {
        return $this->md5;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Attachment
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
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return Attachment
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContentId()
    {
        return $this->contentId;
    }

    /**
     * @return Attachment
     * @param mixed $contentId
     */
    public function setContentId($contentId)
    {
        $this->contentId = $contentId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNewsfeed()
    {
        return $this->newsfeed;
    }

    /**
     * @return Attachment
     * @param mixed $newsfeed
     */
    public function setNewsfeed($newsfeed)
    {
        $this->newsfeed = $newsfeed;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNewsfeedId()
    {
        return $this->newsfeedId;
    }

    /**
     * @return Attachment
     * @param mixed $newsfeedId
     */
    public function setNewsfeedId($newsfeedId)
    {
        $this->newsfeedId = $newsfeedId;
        return $this;
    }

    public function __toString()
    {
        return $this->md5;
    }
}
