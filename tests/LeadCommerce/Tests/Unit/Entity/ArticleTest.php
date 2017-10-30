<?php

namespace LeadCommerce\Tests\Unit;

use LeadCommerce\Shopware\SDK\Entity\Article;
use PHPUnit\Framework\TestCase;

/**
 * Class ArticleTest
 * @package LeadCommerce\Tests\Unit
 */
class ArticleTest extends TestCase
{
    public function testThatArrayCopyDoesNotReturnArrayElementsWithNullValue()
    {
        $attributes['id'] = 1;
        $attributes['name'] = 'foo';
        $attributes['taxId'] = null;

        $entity = new Article();
        $entity->setEntityAttributes($attributes);
        $arrayCopy = $entity->getArrayCopy();

        static::assertArrayNotHasKey('taxId', $arrayCopy);
        static::assertArrayHasKey('name', $arrayCopy);
        static::assertArrayHasKey('id', $arrayCopy);
    }
}
