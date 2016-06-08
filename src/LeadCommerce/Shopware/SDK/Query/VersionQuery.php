<?php

namespace LeadCommerce\Shopware\SDK\Query;


class VersionQuery extends Base
{

    /**
     * @return mixed
     */
    protected function getClass()
    {
        return 'stdClass';
    }
    
    protected function getVersion()
    {
        return $this->fetchJson('/version');
    }
}