<?php
declare(strict_types = 1);

namespace Mikemirten\Component\Mapper\Accessor;

use Mikemirten\Component\Mapper\Metadata\PropertyMetadataInterface as PropertyMetadata;

/**
 * Reflection-based accessor
 * Interacts with properties directly
 *
 * @package Mikemirten\Component\Mapper\Accessor
 */
class ReflectionAccessor implements AccessorInterface
{
    /**
     * Cache of reflections
     *
     * @var \ReflectionProperty[]
     */
    private $reflectionCache;

    /**
     * {@inheritdoc}
     */
    public function set($object, $value, PropertyMetadata $property)
    {
        $propertyName = $property->getName();
        $reflection   = $this->getReflection($object, $propertyName);

        if ($reflection->isPublic()) {
            $object->$propertyName = $value;
            return;
        }

        $reflection->setAccessible(true);
        $reflection->setValue($object, $value);
        $reflection->setAccessible(false);
    }

    /**
     * {@inheritdoc}
     */
    public function get($object, PropertyMetadata $property)
    {
        $propertyName = $property->getName();
        $reflection   = $this->getReflection($object, $propertyName);

        if ($reflection->isPublic()) {
            return $object->$propertyName;
        }

        $reflection->setAccessible(true);
        $value = $reflection->getValue($object);
        $reflection->setAccessible(false);

        return $value;
    }

    /**
     * Get reflection
     *
     * @param  mixed  $object
     * @param  string $name
     * @return \ReflectionProperty
     */
    protected function getReflection($object, string $name): \ReflectionProperty
    {
        $class = get_class($object);
        $id = $class . ':' . $name;

        if (! isset($this->reflectionCache[$id])) {
            $this->reflectionCache[$id] = new \ReflectionProperty($class, $name);
        }

        return $this->reflectionCache[$id];
    }
}