<?php

namespace Web\BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * History
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class History
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
     * @ORM\Column(name="event", type="text")
     */
    private $event;

    /**
     * @var integer
     *
     * @ORM\Column(name="year", type="integer")
     */
    private $year;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="event_at", type="string" , length=255 , nullable=true)
     */
    private $eventAt;

    /**
     * @ORM\Column(name="put_left" , type="boolean" , nullable=true)
     */
    private $putRight;

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
     * Set event
     *
     * @param string $event
     * @return History
     */
    public function setEvent($event)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return string 
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Set year
     *
     * @param integer $year
     * @return History
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer 
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set eventAt
     *
     * @param \DateTime $eventAt
     * @return History
     */
    public function setEventAt($eventAt)
    {
        $this->eventAt = $eventAt;

        return $this;
    }

    /**
     * Get eventAt
     *
     * @return \DateTime 
     */
    public function getEventAt()
    {
        return $this->eventAt;
    }

    /**
     * @return mixed
     */
    public function getPutRight()
    {
        return $this->putRight;
    }

    /**
     * @return History
     * @param mixed $putRight
     */
    public function setPutRight($putRight)
    {
        $this->putRight = $putRight;
        return $this;
    }
}
