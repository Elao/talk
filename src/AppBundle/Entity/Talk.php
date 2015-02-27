<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Talk
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TalkRepository")
 */
class Talk
{
    const UPCOMING = 'upcoming';
    const LIVE     = 'live';
    const PAST     = 'past';

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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="day", type="date")
     */
    private $day;

    /**
     * Video
     *
     * @var Video
     *
     * @ORM\OneToOne(targetEntity="Video", inversedBy="talk", cascade="all")
     * @ORM\JoinColumn(name="video")
     */
    private $video;

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
     * @return Talk
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
     * Set description
     *
     * @param string $description
     *
     * @return Talk
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set day
     *
     * @param DateTime $day
     *
     * @return Talk
     */
    public function setDay(\Datetime $day)
    {
        $this->day = $day;

        return $this;
    }

    /**
     * Get day
     *
     * @return DateTime
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * Set video
     *
     * @param Video $video
     *
     * @return Talk
     */
    public function setVideo(Video $video)
    {
        $this->video = $video;

        return $this;
    }

    /**
     * Get video
     *
     * @return Video
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        if ($this->day === new Datetime) {
            return static::LIVE;
        }

        return $this->day > new Datetime ? static::UPCOMING : static::PAST;
    }
}
