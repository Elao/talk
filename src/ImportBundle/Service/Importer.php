<?php

namespace ImportBundle\Service;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\ProgressBar;
use AppBundle\Entity\Talk;
use AppBundle\Entity\Video;

/**
 * Importer
 */
class Importer
{
    /**
     * Youtube Video Collector
     *
     * @var YoutubeCollector
     */
    private $collector;

    /**
     * Entity manager
     *
     * @var ObjectManager
     */
    private $manager;

    /**
     * Validator
     *
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * Video entity repository
     *
     * @var EntityRepository;
     */
    private $repository;

    /**
     * Output
     *
     * @var OutputInterface
     */
    private $output;

    /**
     * Progress Bar
     *
     * @var ProgressBar
     */
    private $progress;

    /**
     * Injecting dependencies
     *
     * @param YoutubeCollector $collector
     */
    public function __construct(YoutubeCollector $collector, ObjectManager $manager, ValidatorInterface $validator)
    {
        $this->collector = $collector;
        $this->manager   = $manager;
        $this->validator = $validator;
    }

    /**
     * Synchronyze
     */
    public function sync()
    {
        $list = $this->collector->getVideos();

        $this->addProgress(count($list));

        foreach ($list as $item) {
            $talk = $this->getTalkFromYoutube($item);

            if (!count($this->validator->validate($talk))) {
                $this->manager->persist($talk);
            }

            $this->advanceProgress();
        }

        $this->manager->flush();
        $this->finishProgress();
    }

    /**
     * Get or create a talk from youtube video data
     *
     * @param array $data
     *
     * @return Video
     */
    private function getTalkFromYoutube(array $data)
    {
        if (!$video = $this->getRepository()->findOneByYoutubeId($data['id'])) {
            $video = new Video($data['id']);
        }

        if (!$talk = $video->getTalk()) {
            $talk = new Talk();
            $talk->setVideo($video);
        }

        $talk->setTitle($data['snippet']['title']);
        $talk->setDescription($data['snippet']['description']);
        $talk->setDay($data['recordingDetails']['recordingDate']);
        $video->setPublishedAt($data['snippet']['publishedAt']);

        return $talk;
    }

    /**
     * Get Video entity repository
     *
     * @return EntityRepository
     */
    private function getRepository()
    {
        if (!$this->repository) {
            $this->repository = $this->manager->getRepository('AppBundle:Video');
        }

        return $this->repository;
    }

    /**
     * Set output
     *
     * @param OutputInterface $output
     */
    public function setOutput(OutputInterface $output)
    {
        $this->output = $output;
    }

    /**
     * Add progress bar
     *
     * @param integer $max
     */
    public function addProgress($max)
    {
        if ($this->output) {
            $this->progress = new ProgressBar($this->output, $max);
        }
    }

    /**
     * Advance
     */
    public function advanceProgress()
    {
        if ($this->progress) {
            $this->progress->advance();
        }
    }

    /**
     * Finish progress
     */
    public function finishProgress()
    {
        if ($this->progress) {
            $this->progress->finish();
        }
    }
}
