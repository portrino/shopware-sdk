<?php

namespace LeadCommerce\Shopware\SDK\Entity;


/**
 * Class Base
 * @package LeadCommerce\Shopware\SDK\Entity
 * @author Alexander Mahrt <amahrt@leadcommerce.de>
 * @copyright 2016 LeadCommerce <amahrt@leadcommerce.de>
 */
class Base
{
    /**
     * @var array
     */
    protected $_attributes = [];

    /**
     * Sets the attributes of this entity.
     * @param $attributes
     * @return $this
     */
    public function setEntityAttributes($attributes)
    {
        $this->_attributes = $attributes;
        return $this;
    }

    /**
     * @param $name
     * @return null
     */
    public function __get($name)
    {
        if (array_key_exists($name, $this->_attributes)) {
            $this->_attributes[$name];
        }

        return null;
    }

    /**
     * @param $name
     * @param $value
     * @return $this
     */
    public function __set($name, $value)
    {
        $this->_attributes[$name] = $value;
        return $this;
    }

    /**
     * @param $name
     * @param $arguments
     * @return $this|mixed|null
     */
    public function __call($name, $arguments)
    {
        $command = substr($name, 0, 3);
        $property = substr($name, 3);

        if ($command == 'get') {
            if (array_key_exists($property, $this->_attributes)) {
                return $this->_attributes[$property];
            }
        } else if ($command == 'set') {
            $value = count($arguments) > 0 ? $arguments[0] : null;
            $this->_attributes[$property] = $value;
            return $this;
        }

        return null;
    }
}
