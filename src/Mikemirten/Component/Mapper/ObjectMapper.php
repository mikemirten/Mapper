<?php
declare(strict_types = 1);

namespace Mikemirten\Component\Mapper;

use Mikemirten\Component\Mapper\Accessor\AccessorInterface;
use Mikemirten\Component\Mapper\Metadata\ClassMetadataInterface;
use Mikemirten\Component\Mapper\Metadata\ProviderInterface;

/**
 * The object mapper
 *
 * @package Mikemirten\Component\Mapper
 */
class ObjectMapper
{
    /**
     * Property accessor
     *
     * @var AccessorInterface
     */
    protected $accessor;

    /**
     * Metadata provider
     *
     * @var ProviderInterface
     */
    protected $provider;

    /**
     * Cache of created reflections
     *
     * @var ClassMetadataInterface[]
     */
    private $metadataCache = [];

    /**
     * ObjectMapper constructor.
     *
     * @param AccessorInterface $accessor Property accessor
     * @param ProviderInterface $provider Metadata provider
     */
    public function __construct(AccessorInterface $accessor, ProviderInterface $provider)
    {
        $this->accessor = $accessor;
        $this->provider = $provider;
    }

    /**
     * Set data to object
     *
     * @param $object
     * @param array $data
     */
    public function set($object, array $data)
    {
        $metadata = $this->getMetadata($object);

        foreach ($data as $property => $value)
        {
            $propertyMetadata = $metadata->getPropertyMetadata($property);

            $this->accessor->set($object, $value, $propertyMetadata);
        }
    }

    /**
     * Get data from object
     *
     * @param  $object
     * @return array
     */
    public function get($object): array
    {
        $metadata = $this->getMetadata($object);

        $data = [];

        foreach ($metadata->getPropertiesMetadata() as $propertyMetadata)
        {
            $name = $propertyMetadata->getName();

            $data[$name] = $this->accessor->get($object, $propertyMetadata);
        }

        return $data;
    }

    /**
     * Get metadata for given object
     *
     * @param  $object
     * @return ClassMetadataInterface
     */
    protected function getMetadata($object): ClassMetadataInterface
    {
        $class = get_class($object);

        if (! isset($this->metadataCache[$class])) {
            $reflection = new \ReflectionClass($object);

            $this->metadataCache[$class] = $this->provider->getClassMetadata($reflection);
        }

        return $this->metadataCache[$class];
    }
}