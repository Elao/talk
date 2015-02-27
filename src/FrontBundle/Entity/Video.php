<?php

namespace FrontBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Video
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="FrontBundle\Repository\VideoRepository")
 */
class Video
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
     * @ORM\Column(name="youtubeId", type="string", length=255)
     */
    private $youtubeId;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="publishedAt", type="datetime")
     */
    private $publishedAt;

    /**
     * Talk
     *
     * @var Talk
     *
     * @ORM\OneToOne(targetEntity="Talk", mappedBy="video")
     */
    private $talk;

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
     * COnstructor
     *
     * @param string $youtubeId
     */
    public function __construct($youtubeId)
    {
        $this->youtubeId = $youtubeId;
    }

    /**
     * Get youtubeId
     *
     * @return string
     */
    public function getYoutubeId()
    {
        return $this->youtubeId;
    }

    /**
     * Set publishedAt
     *
     * @param DateTime $publishedAt
     *
     * @return Video
     */
    public function setPublishedAt(DateTime $publishedAt)
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    /**
     * Get publishedAt
     *
     * @return DateTime
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * Get talk
     *
     * @return Talk
     */
    public function getTalk()
    {
        return $this->talk;
    }
}
