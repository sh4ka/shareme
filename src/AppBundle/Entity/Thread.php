<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Thread
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Thread
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
     * @ORM\Column(name="hash", type="string", length=160)
     */
    private $hash;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="Participant", inversedBy="creations")
     * @ORM\JoinColumn(name="creator_id", referencedColumnName="id")
     **/
    private $createdBy;

    /**
     * @ORM\ManyToMany(targetEntity="Participant", cascade={"persist"})
     * @ORM\JoinTable(name="participants_threads",
     *      joinColumns={@ORM\JoinColumn(name="thread_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="participant_id", referencedColumnName="id")}
     *      )
     **/
    private $participants;

    /**
     * @ORM\ManyToMany(targetEntity="Content", inversedBy="threads", cascade={"persist"})
     * @ORM\JoinTable(name="threads_contents")
     **/
    private $contents;

    public function __construct() {
        $this->participants = new \Doctrine\Common\Collections\ArrayCollection();
        $this->contents = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set hash
     *
     * @param string $hash
     * @return Thread
     */
    public function setHash($hash)
    {
        $this->hash = $hash;

        return $this;
    }

    /**
     * Get hash
     *
     * @return string 
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * <description>
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * <description>
     *
     * @param string $title <param_description>
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }


    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Thread
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
     * @param Participant $participant
     */
    public function addParticipant(Participant $participant){
        if(!$this->participants->contains($participant)){
            $this->participants->add($participant);
        }
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getContents(){
        return $this->contents;
    }

    /**
     * @param Content $content
     */
    public function addContent(Content $content){
        if(!$this->contents->contains($content)){
            $this->contents->add($content);
        }
    }

    /**
     * <description>
     *
     * @return mixed
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * <description>
     *
     * @param mixed $createdBy <param_description>
     *
     * @return $this
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;
        return $this;
    }

    /**
     * <description>
     *
     * @return mixed
     */
    public function getParticipants()
    {
        return $this->participants;
    }

    /**
     * <description>
     *
     * @param mixed $participants <param_description>
     *
     * @return $this
     */
    public function setParticipants($participants)
    {
        $this->participants = $participants;
        return $this;
    }

}
