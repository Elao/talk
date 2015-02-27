<?php

namespace ImportBundle\Model\Call;

/**
* Get Channel call
*/
class GetChannelCall extends YoutubeApiCall
{
    /**
     * {@inheritdoc}
     */
    protected function getName()
    {
        return 'channels';
    }
}
