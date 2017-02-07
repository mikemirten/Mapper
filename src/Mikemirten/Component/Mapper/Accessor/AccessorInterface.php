<?php
declare(strict_types = 1);

namespace Mikemirten\Component\Mapper\Accessor;

/**
 * Interface of property accessor
 *
 * @package Mikemirten\Component\Mapper\Accessor
 */
interface AccessorInterface
{
    /**
     * Set value to property of object
     *
     * @param $object
     * @param string $property
     * @param $value
     */
    public function set($object, string $property, $value);

    /**
     * Get value from property of object
     *
     * @param $object
     * @param string $property
     */
    public function get($object, string $property);
}