<?php

namespace LeadCommerce\Shopware\SDK\Query;


use LeadCommerce\Shopware\SDK\ShopwareClient;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Base
 * @package LeadCommerce\Shopware\SDK\Query
 * @author Alexander Mahrt <amahrt@leadcommerce.de>
 * @copyright 2016 LeadCommerce <amahrt@leadcommerce.de>
 */
abstract class Base
{
    /**
     * @var ShopwareClient
     */
    protected $client;

    /**
     * Base constructor.
     * @param $client
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * @param string $method
     * @param $uri
     * @param null $body
     * @param array $headers
     * @return array|mixed
     */
    protected function fetch($method = 'GET', $uri, $body = null, $headers = [])
    {
        $response = $this->client->request($method, $uri, $body, $headers);
        return $this->createEntityFromResponse($response);
    }

    /**
     * @param ResponseInterface $response
     * @return array|mixed
     */
    protected function createEntityFromResponse(ResponseInterface $response)
    {
        $content = $response->getBody()->getContents();
        $content = json_decode($content);

        if (is_array($content)) {
            return array_map(function ($item) {
                return $this->createEntity($item);
            }, $content);
        } else {
            return $this->createEntity($content);
        }
    }

    /**
     * @param $content
     * @return mixed
     */
    protected function createEntity($content)
    {
        $class = $this->getClass();
        $entity = new $class();

        if ($entity instanceof \LeadCommerce\Shopware\SDK\Entity\Base) {
            $content = json_decode(json_encode($content), true);
            $entity->setEntityAttributes($content);
        }
        return $entity;
    }

    /**
     * @return mixed
     */
    protected abstract function getClass();
}
