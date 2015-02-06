<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Submission
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Submission
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
     * @var \DateTime
     *
     * @ORM\Column(name="date_added", type="datetimetz", nullable=true)
     */
    private $dateAdded;

    /**
     * @var boolean
     *
     * @ORM\COlumn(name="banned", type="boolean", nullable=TRUE)
     */
    private $banned;

    /**
     * @ORM\ManyToOne(targetEntity="Thread", inversedBy="submissions")
     * @ORM\JoinColumn(name="thread_id", referencedColumnName="id", nullable=FALSE)
     */
    protected $thread;

    /**
     * @ORM\ManyToOne(targetEntity="Content", inversedBy="submissions")
     * @ORM\JoinColumn(name="content_id", referencedColumnName="id", nullable=FALSE)
     */
    protected $content;


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
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     * @return Submission
     */
    public function setDateAdded($dateAdded)
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    /**
     * Get dateAdded
     *
     * @return \DateTime 
     */
    public function getDateAdded()
    {
        return date_format($this->dateAdded, 'd-m-Y');
    }

    /**
     * @return mixed
     */
    public function getThread()
    {
        return $this->thread;
    }

    /**
     * @param mixed $thread
     */
    public function setThread($thread)
    {
        $this->thread = $thread;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getUrl(){
        return $this->getContent()->getUrl();
    }

    public function getOwner(){
        return $this->getThread()->getCreatedBy()->getEmail();
    }

    /**
     * @return boolean
     */
    public function isBanned()
    {
        return $this->banned;
    }

    /**
     * @param boolean $banned
     */
    public function setBanned($banned)
    {
        $this->banned = $banned;
    }



}
