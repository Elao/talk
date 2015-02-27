<?php

namespace ImportBundle\Model\Call;

/**
 * Youtube API Call
 */
abstract class YoutubeApiCall
{
    /**
     * API URL
     */
    const API_URL = 'https://www.googleapis.com/youtube/v3/';

    /**
     * API Key
     *
     * @var string
     */
    protected $apiKey;

    /**
     * Id value
     *
     * @var string
     */
    protected $id;

    /**
     * Parameters
     *
     * @var array
     */
    protected $parameters;

    /**
     * Constructor
     * @param string $id
     * @param array $parameters
     */
    public function __construct($id, array $parameters = array())
    {
        $this->id         = $id;
        $this->parameters = $parameters;
    }

    /**
     * Get the name of the API
     *
     * @return string
     */
    abstract protected function getName();

    /**
     * Set API key
     *
     * @param string $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * Get API key
     *
     * @return string
     */
    protected function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * Get parts
     *
     * @return array
     */
    protected function getParts()
    {
        return ['id', 'contentDetails'];
    }

    /**
     * Get parameters
     *
     * @return array
     */
    protected function getParameters()
    {
        return $this->parameters;
    }

    /**
     * Get identifier
     *
     * @return array
     */
    protected function getIdentifier()
    {
        return ['id' => $this->id];
    }

    /**
     * Get params
     *
     * @return array
     */
    protected function getParams()
    {
        return array_merge(
            $this->getParameters(),
            $this->getIdentifier(),
            [
                'key'  => $this->apiKey,
                'part' => implode(',', $this->getParts()),
            ]
        );
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return sprintf(
            '%s%s?%s',
            static::API_URL,
            $this->getName(),
            http_build_query($this->getParams())
        );
    }
}
