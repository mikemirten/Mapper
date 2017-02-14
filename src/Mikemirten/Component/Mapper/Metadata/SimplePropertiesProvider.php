<?php
declare(strict_types = 1);

namespace Mikemirten\Component\Mapper\Metadata;

/**
 * Simple provider of list of declared properties
 *
 * @package Mikemirten\Component\Mapper\Metadata
 */
class SimplePropertiesProvider implements ProviderInterface
{
    /**
     * Cache of created metadata
     *
     * @var ClassMetadataInterface[]
     */
    private $metadataCache = [];

    /**
     * {@inheritdoc}
     */
    public function getClassMetadata(\ReflectionClass $reflection): ClassMetadataInterface
    {
        $class = $reflection->getName();

        if (! isset($this->metadataCache[$class])) {
            $this->metadataCache[$class] = $this->createClassMetadata($reflection);
        }

        return $this->metadataCache[$class];
    }

    /**
     * Create class metadata
     *
     * @param  \ReflectionClass $reflection
     * @return ClassMetadataInterface
     */
    protected function createClassMetadata(\ReflectionClass $reflection): ClassMetadataInterface
    {
        $metadata = new ClassMetadata($reflection->getName());

        foreach ($reflection->getProperties() as $property)
        {
            $metadata->addPropertyMetadata($this->createPropertyMetadata($property));
        }

        $parent = $reflection->getParentClass();

        if ($parent !== false) {
            $parentMetadata = $this->createClassMetadata($parent);

            $metadata->merge($parentMetadata);
        }

        foreach ($reflection->getTraits() as $trait)
        {
            $traitMetadata = $this->createClassMetadata($trait);

            $metadata->merge($traitMetadata);
        }

        return $metadata;
    }

    /**
     * Create property metadata
     *
     * @param  \ReflectionProperty $reflection
     * @return PropertyMetadataInterface
     */
    protected function createPropertyMetadata(\ReflectionProperty $reflection): PropertyMetadataInterface
    {
        $property = new PropertyMetadata($reflection->getName());

        $comment = $reflection->getDocComment();

        if (empty($comment)) {
            return $property;
        }

        if (preg_match('~@var\s+\\\?([a-z0-9]+)~i', $comment, $matches)) {
            $property;
        }

        return $property;
    }
}