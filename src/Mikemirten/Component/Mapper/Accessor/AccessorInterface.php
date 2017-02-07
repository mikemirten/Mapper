<?php
declare(strict_types = 1);

namespace Mikemirten\Component\Mapper\Accessor;
use Mikemirten\Component\Mapper\Metadata\PropertyMetadataInterface;

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
     * @param mixed $object
     * @param mixed $value
     * @param PropertyMetadataInterface $property
     */
    public function set($object, $value, PropertyMetadataInterface $property);

    /**
     * Get value from property of object
     *
     * @param  mixed $object
     * @param  PropertyMetadataInterface $property
     * @return mixed
     */
    public function get($object, PropertyMetadataInterface $property);
}