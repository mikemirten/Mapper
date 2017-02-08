<?php
declare(strict_types = 1);

namespace Mikemirten\Component\Mapper\Metadata;
use Mikemirten\Component\Mapper\Exception\PropertyMetadataOverrideException;
use Mikemirten\Component\Mapper\Exception\PropertyNotFoundException;

/**
 * Container of class metadata
 *
 * @package Mikemirten\Component\Mapper\Metadata
 */
class ClassMetadata implements ClassMetadataInterface
{
    /**
     * Name of class
     *
     * @var string
     */
    protected $name;

    /**
     * Metadata of properties
     *
     * @var PropertyMetadataInterface[]
     */
    private $properties = [];

    /**
     * ClassMetadata constructor.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Add property metadata
     *
     * @param  PropertyMetadataInterface $property
     * @throws PropertyMetadataOverrideException
     */
    public function addPropertyMetadata(PropertyMetadataInterface $property)
    {
        $name = $property->getName();

        if (isset($this->properties[$name])) {
            throw new PropertyMetadataOverrideException($name);
        }

        $this->properties[$name] = $property;
    }

    /**
     * {@inheritdoc}
     */
    public function getPropertyMetadata(string $name): PropertyMetadataInterface
    {
        if (isset($this->properties[$name])) {
            return $this->properties[$name];
        }

        throw new PropertyNotFoundException($name, $this);
    }

    /**
     * {@inheritdoc}
     */
    public function hasPropertyMetadata(string $name): bool
    {
        return isset($this->properties[$name]);
    }

    /**
     * {@inheritdoc}
     */
    public function getPropertiesMetadata(): array
    {
        return $this->properties;
    }
}