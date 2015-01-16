<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Content
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Content
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
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="hash", type="string", length=160)
     */
    private $hash;

    /**
     * @ORM\ManyToMany(targetEntity="Thread", mappedBy="contents")
     **/
    private $threads;

    public function __construct() {
        $this->threads = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set url
     *
     * @param string $url
     * @return Content
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * <description>
     *
     * @return mixed
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * <description>
     *
     * @param mixed $hash <param_description>
     *
     * @return $this
     */
    public function setHash($hash)
    {
        $this->hash = $hash;
        return $this;
    }

    /**
     * <description>
     *
     * @return mixed
     */
    public function getThreads()
    {
        return $this->threads;
    }

    /**
     * <description>
     *
     * @param mixed $threads <param_description>
     *
     * @return $this
     */
    public function setThreads($threads)
    {
        $this->threads = $threads;
        return $this;
    }
}
