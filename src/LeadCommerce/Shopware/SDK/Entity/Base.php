<?php

namespace LeadCommerce\Shopware\SDK\Entity;

/**
 * Class Base
 *
 * @author Alexander Mahrt <amahrt@leadcommerce.de>
 * @copyright 2016 LeadCommerce <amahrt@leadcommerce.de>
 */
class Base
{
    /**
     * @var int
     */
    protected $id;

    /**
     * Sets the attributes of this entity.
     *
     * @param array $attributes
     *
     * @return $this
     */
    public function setEntityAttributes(array $attributes)
    {
        foreach ($attributes as $attribute => $value) {
            $setter = 'set' . ucfirst($attribute);
            if (method_exists($this, $setter)) {
                $this->$setter($value);
            }
        }

        return $this;
    }

    /**
     * Gets the attributes of this entity.
     *
     * @return array
     */
    public function getArrayCopy()
    {
        $array = get_object_vars($this);

        foreach ($array as $key => &$value) {
            if ($value instanceof Base) {
                $array[$key] = $value->getArrayCopy();
            } else if (is_array($value)) {
                foreach ($value as $k => $v) {
                    if ($v instanceof Base) {
                        $value[$k] = $v->getArrayCopy();
                    }
                }
            }
        }
        return $array;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return Base
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
