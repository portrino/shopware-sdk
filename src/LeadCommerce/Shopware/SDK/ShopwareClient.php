<?php

namespace LeadCommerce\Shopware\SDK;


use GuzzleHttp\Client;

/**
 * Class ShopwareClient
 * @package LeadCommerce\Shopware\SDK
 * @author Alexander Mahrt <amahrt@leadcommerce.de>
 * @copyright 2016 LeadCommerce <amahrt@leadcommerce.de>
 */
class ShopwareClient
{
    const VERSION = '0.0.1';

    /**
     * @var string|null
     */
    protected $baseUrl;

    /**
     * @var string|null
     */
    protected $username;

    /**
     * @var string|null
     */
    protected $apiKey;

    /**
     * @var Client
     */
    protected $client;

    /**
     * ShopwareClient constructor.
     * @param $baseUrl
     * @param null $username
     * @param null $apiKey
     */
    public function __construct($baseUrl, $username = null, $apiKey = null)
    {
        $this->baseUrl = $baseUrl;
        $this->username = $username;
        $this->apiKey = $apiKey;
        $this->client = new Client([
            'base_uri' => $this->baseUrl,
        ]);
    }

    /**
     * Does a request.
     * @param string $method
     * @param $uri
     * @param null $body
     * @param array $headers
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function request($method = 'GET', $uri, $body = null, $headers = [])
    {
        if (empty($headers['Accept'])) {
            $headers['Accept'] = 'application/json';
        }

        if (empty($headers['Content-Type'])) {
            $headers['Content-Type'] = 'application/json';
        }

        return $this->client->request($method, $uri, [
            'body' => $body,
            'headers' => $headers,
            'auth' => [
                $this->username,
                $this->apiKey,
                'digest'
            ]
        ]);
    }


    /**
     * Magically get the query classes.
     * @param $name
     * @param array $arguments
     * @return bool
     */
    public function __call($name, $arguments = [])
    {
        if (!preg_match('/^get([a-z]+)Query$/i', $name, $matches)) {
            return false;
        }

        $className = __NAMESPACE__ . "\\Query\\" . $matches[0];

        if (!class_exists($className)) {
            return false;
        }

        return new $className($this);
    }
}
