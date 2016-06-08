<?php

namespace LeadCommerce\Shopware\SDK\Query;


class ArticleQuery extends Base
{

    /**
     * @return mixed
     */
    protected function getClass()
    {
        return 'LeadCommerce\\Shopware\\SDK\\Entity\\Article';
    }
}