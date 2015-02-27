<?php

namespace FrontBundle\Twig;

use Twig_Extension;
use Twig_SimpleFunction;
use Model\Video;

/**
 * Youtube utilities for Twig
 */
class YoutubeExtension extends Twig_Extension
{
    const RES_DEFAULT = 'default';
    const RES_MQ      = 'mqdefault';
    const RES_HQ      = 'hqdefault';
    const RES_SD      = 'sddefault';
    const RES_MAXRES  = 'maxresdefault';

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'youtube_extension';
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('yt_thumbnail', [$this, 'getThumbnail']),
        ];
    }

    /**
     * Get Youtube thumbnail
     *
     * @param Video $video
     * @param string $quality null|mq|hq|sd|maxres
     *
     * @return string
     */
    public function getThumbnail(Video $video, $quality = null)
    {
        return sprintf(
            'https://i.ytimg.com/vi/%s/%s.jpg',
            $video->getYoutubeId(),
            $quality ?: static::RES_DEFAULT
        );
    }
}
