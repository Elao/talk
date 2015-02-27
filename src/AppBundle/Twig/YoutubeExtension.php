<?php

namespace AppBundle\Twig;

use AppBundle\Entity\Video;

/**
 * Youtube utilities for Twig
 */
class YoutubeExtension extends \Twig_Extension
{
    const RES_DEFAULT = 'default';
    const RES_MQ      = 'mqdefault';
    const RES_HQ      = 'hqdefault';
    const RES_SD      = 'sddefault';
    const RES_MAXRES  = 'maxresdefault';

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('price', array($this, 'priceFilter')),
        );
    }

    /**
     * GEt thumbnail
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

    public function getPlayer(Video $video)
    {
        "<iframe type='text/html' src='http://www.youtube.com/embed/fraqAEdGgkA' width='640' height='360' frameborder='0' allowfullscreen='true'/>"
    }

    public function getName()
    {
        return 'youtube_extension';
    }
}
