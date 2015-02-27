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
     * Construct
     *
     * @param string $apiKey
     */
    public function __construct($apiKey)
    {
        $this->client = new GuzzleHttp\Client();
        $this->apiKey = $apiKey;
    }

    /**
     * Get videos
     *
     * @param string $playlist
     *
     * @return array
     */
    public function getVideos($playlist)
    {
        $result = $this->getPlaylistItems($playlist);
        $videos = [];

        foreach ($result['items'] as $item) {
            $video = $this->getVideo($item['contentDetails']['videoId'])['items'][0];

            $video['snippet']['publishedAt'] = DateTime::createFromFormat(
                static::YOUTUBE_DATE_FORMAT,
                $video['snippet']['publishedAt']
            );

            $video['recordingDetails']['recordingDate'] = DateTime::createFromFormat(
                static::YOUTUBE_DATE_FORMAT,
                $video['recordingDetails']['recordingDate']
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

    /**
     * Parse Youtube formated date
     *
     * @param string $date
     *
     * @return DateTime
     */
    private function parseDate($date)
    {
        return DateTime::createFromFormat(static::YOUTUBE_DATE_FORMAT, $date);
    }
}
