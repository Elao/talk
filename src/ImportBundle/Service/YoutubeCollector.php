<?php

namespace ImportBundle\Service;

use DateTime;
use GuzzleHttp;
use ImportBundle\Model\Call;

/**
 * Youtube Video Collector
 */
class YoutubeCollector
{
    /**
     * Youtube date format
     */
    const YOUTUBE_DATE_FORMAT = 'Y-m-d\TH:i:s.000\Z';

    /**
     * Client
     *
     * @var Client
     */
    private $client;

    /**
     * API Key
     *
     * @var string
     */
    private $apiKey;

    /**
     * Playlist ID
     *
     * @var string
     */
    private $playlist;

    /**
     * Construct
     *
     * @param string $apiKey
     * @param string $playlist
     */
    public function __construct($apiKey, $playlist)
    {
        $this->client    = new GuzzleHttp\Client();
        $this->apiKey    = $apiKey;
        $this->playlist = $playlist;
    }

    /**
     * Get videos
     */
    public function getVideos()
    {
        $result = $this->getPlaylistItems($this->playlist);
        $videos = [];

        foreach ($result['items'] as $item) {
            $video = $this->getVideo($item['contentDetails']['videoId'])['items'][0];

            $video['snippet']['publishedAt'] = DateTime::createFromFormat(
                static::YOUTUBE_DATE_FORMAT,
                $video['snippet']['publishedAt']
            );

            $videos[] = $video;
        }

        return $videos;
    }

    /**
     * Get channel
     *
     * @param string $id
     *
     * @return array
     */
    private function getChannel($id)
    {
        return $this->execute(new Call\GetChannelCall($id));
    }

    /**
     * Get playlist items
     *
     * @param string $id
     *
     * @return array
     */
    private function getPlaylistItems($id)
    {
        return $this->execute(new Call\GetPlaylistItemsCall($id, ['maxResults' => 50]));
    }

    /**
     * Get video
     *
     * @param string $id
     *
     * @return array
     */
    private function getVideo($id)
    {
        return $this->execute(new Call\GetVideoCall($id));
    }

    /**
     * Execute the given API call
     *
     * @param Call\YoutubeApiCall $call
     *
     * @return Response
     */
    private function execute(Call\YoutubeApiCall $call)
    {
        $call->setApiKey($this->apiKey);

        return $this->client->get($call->getUrl())->json();
    }
}
