<?php

namespace LeadCommerce\Shopware\SDK;


use Guzzle\Http\Client;

class ShopwareClient extends Client
{
    public function __construct($baseUrl, $config)
    {
        $guzzleConfig = [

        ];

        parent::__construct($baseUrl, $guzzleConfig);
    }
}
