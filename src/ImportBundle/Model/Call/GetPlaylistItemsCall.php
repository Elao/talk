<?php

namespace ImportBundle\Model\Call;

/**
* Get Playlist Items call
*/
class GetPlaylistItemsCall extends YoutubeApiCall
{
    /**
     * {@inheritdoc}
     */
    protected function getName()
    {
        return 'playlistItems';
    }

    /**
     * Get identifier
     *
     * @return array
     */
    protected function getIdentifier()
    {
        return ['playlistId' => $this->id];
    }
}
