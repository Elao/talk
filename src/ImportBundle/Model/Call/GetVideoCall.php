<?php

namespace ImportBundle\Model\Call;

/**
* Get Video call
*/
class GetVideoCall extends YoutubeApiCall
{
    /**
     * {@inheritdoc}
     */
    protected function getName()
    {
        return 'videos';
    }

    /**
     * {@inheritdoc}
     */
    protected function getParts()
    {
        return ['id', 'player', 'snippet'];
    }
}
